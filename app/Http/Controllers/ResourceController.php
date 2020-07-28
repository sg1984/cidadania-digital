<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Subject;
use App\Tag;
use App\UploadedFile;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ResourceController extends Controller
{
    /**
     * ResourceController constructor.
     *
     * @return void|Redirector|RedirectResponse
     */
    public function __construct()
    {
        if(!auth()->check()) {
            return redirect('/resources');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $resources = Resource::with('subject', 'user', 'tags');
        if (!auth()->user()->isAdmin()) {
            $resources->where('created_by', auth()->id());
        }

        $resources = $resources
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('resources.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $resource = new Resource();
        $tags = Tag::query()
            ->isActive()
            ->orderBy('name')
            ->get();
        $userSubjects = auth()->user()->isAdmin() ? Subject::all() : auth()->user()->subjects;
        $formats = Resource::FORMAT_TYPES;

        return view('resources.edit', compact('resource', 'tags', 'userSubjects', 'formats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $uploadedFile = $request->file('source_file');
            $sourceLink = $request->get('source');
            if ((empty($uploadedFile) && empty($sourceLink))
                || (!empty($uploadedFile) && !empty($sourceLink))) {
                return back()->withInput()->withErrors(['Favor enviar Link ou um Arquivo']);
            }
            $fileMetadata = null;
            if ($uploadedFile) {
                $errorMessage = $uploadedFile->getError() ? $uploadedFile->getErrorMessage() : false;
                if ($errorMessage) {
                    return back()->withInput()->withErrors(['Erro com o arquivo enviado. Erro: ' . $errorMessage]);
                }

                $sourceLink = $uploadedFile->store('public/documents/' . auth()->user()->id);

                $fileMetadata = new UploadedFile([
                    'path'          => $sourceLink,
                    'original_name' => $uploadedFile->getClientOriginalName(),
                    'mimeType'      => $uploadedFile->getMimeType(),
                    'size'          => $uploadedFile->getSize(),
                    'uploaded_by'   => auth()->id(),
                ]);
            }
            $storeData = $request->all([
                'title', 'author', 'key_words', 'description', 'publisher',
                'format_id', 'language', 'subject_id', 'coverage',
                'contributor', 'copy_rights', 'original_date', 'format', 'identifier',
            ]);
            $storeData['source'] = $sourceLink;
            $storeData['created_by'] = auth()->id();
            $storeData['published_at'] = $request->get('publish_now') ? new \DateTime() : null;
            $resource = Resource::create($storeData);
            $resource->tags()->attach($request->get('tags'), [
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]);
            if ($fileMetadata) {
                $resource->uploadedFile()->save($fileMetadata);
            }
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['Erro ao salvar o documento, favor tentar novamente. Erro: ' . $e->getMessage()]);
        }

        return redirect()->route('resources.index')->with('success', 'Documento salvo com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param Resource $resource
     * @return Response
     */
    public function show(Resource $resource)
    {
        return view('resources.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Resource $resource
     * @return Response
     */
    public function edit(Resource $resource)
    {
        $tags = Tag::query()
            ->isActive()
            ->orderBy('name')
            ->get();
        $userSubjects = auth()->user()->isAdmin() ? Subject::all() : auth()->user()->subjects;
        $formats = Resource::FORMAT_TYPES;

        return view('resources.edit', compact('resource', 'userSubjects', 'tags', 'formats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request  $request
     * @param Resource $resource
     * @return RedirectResponse
     */
    public function update(Request $request, Resource $resource)
    {
        try {
            $uploadedFile = $request->file('source_file');
            $sourceFormLink = $request->get('source');
            if (!empty($uploadedFile) && !empty($sourceFormLink)) {
                return back()->withInput()->withErrors(['Favor enviar Link ou um arquivo']);
            }
            $hasSourceChanged = false;
            $sourceLink = null;
            $fileMetadata = null;
            $oldSource = $resource->source;
            if ($uploadedFile) {
                $errorMessage = $uploadedFile->getError() ? $uploadedFile->getErrorMessage() : false;
                if ($errorMessage) {
                    return back()->withInput()->withErrors(['Erro com o arquivo enviado. Erro: ' . $errorMessage]);
                }

                $sourceLink = $uploadedFile->store('public/documents/' . auth()->user()->id);

                $fileMetadata = new UploadedFile([
                    'path'          => $sourceLink,
                    'original_name' => $uploadedFile->getClientOriginalName(),
                    'mimeType'      => $uploadedFile->getMimeType(),
                    'size'          => $uploadedFile->getSize(),
                    'uploaded_by'   => auth()->id(),
                ]);

                $hasSourceChanged = true;
            }
            if (!empty($sourceFormLink) && $sourceFormLink !== $oldSource) {
                $sourceLink = $sourceFormLink;
                $hasSourceChanged = true;
            }
            $storeData = $request->all([
                'title', 'author', 'key_words', 'description', 'publisher',
                'format_id', 'language', 'subject_id', 'coverage',
                'contributor', 'copy_rights', 'original_date', 'format', 'identifier',
            ]);
            $storeData['published_at'] = $request->get('publish_now') ? new \DateTime() : null;
            if ($sourceLink && $hasSourceChanged) {
                $storeData['source'] = $sourceLink;
            }
            $oldTags = $resource->tags()->pluck('id');
            $resource->update($storeData);
            $resource->tags()->detach($oldTags);
            $resource->tags()->attach($request->get('tags'), [
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]);
            if ($hasSourceChanged) {
                $resource->uploadedFile()->delete();
                Storage::delete($oldSource);
            }
            if ($fileMetadata) {
                $resource->uploadedFile()->save($fileMetadata);
            }
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['Erro ao atualizar o documento, favor tentar novamente. Erro: ' . $e->getMessage()]);
        }

        return redirect()->route('resources.index')->with('success', 'Documento atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Resource $resource
     * @return Response
     * @throws \Exception
     */
    public function destroy(Resource $resource)
    {
        $resource->delete();

        return redirect()->route('resources.index')->with('success', 'Documento apagado com sucesso!');
    }

    /**
     * @param int $tagId
     * @return Factory|View
     */
    public function searchByTag(int $tagId)
    {
        $tag = Tag::find($tagId);
        $searchBy = $tag->name;
        $resources = $tag
            ->resources()
            ->published()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('resources.contents', compact('resources', 'searchBy'));
    }

    /**
     * @param int $subjectId
     * @return Factory|View
     */
    public function searchBySubject(int $subjectId)
    {
        $subject = Subject::find($subjectId);
        $searchBy = $subject->name;
        $resources = $subject->resources()
            ->published()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('resources.contents', compact('resources', 'searchBy'));
    }

    /**
     * @param int $typeId
     * @return Factory|View
     */
    public function searchByFormat(int $typeId)
    {
        $searchBy = Resource::FORMAT_TYPES[$typeId];
        $resources = Resource::where('format_id', $typeId)
            ->published()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('resources.contents', compact('resources', 'searchBy'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function showAll(Request $request)
    {
        $searchRequest = $request->get('search', null);
        $resources = Resource::query();

        if($searchRequest) {
            $searchBy = $searchRequest;
            $resources->where('title', 'LIKE', "%{$searchRequest}%")
                ->orWhere('key_words', 'LIKE', "%{$searchRequest}%")
                ->orWhere('description', 'LIKE', "%{$searchRequest}%")
                ->orWhere('author', 'LIKE', "%{$searchRequest}%")
                ->orWhereHas('tags', function (Builder $query) use ($searchRequest) {
                    $query->where('name', 'LIKE', "%{$searchRequest}%");
                }, '>=', 1)
                ->orWhereHas('subject', function (Builder $query) use ($searchRequest) {
                    $query->where('name', 'LIKE', "%{$searchRequest}%");
                }, '>=', 1);
        } else {
            $searchBy = 'Tudo';
        }
        $resources = $resources
            ->published()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('resources.contents', compact('resources', 'searchBy'));
    }

    /**
     * @param int $userId
     * @return Application|Factory|View
     */
    public function showByUser(int $userId)
    {
        $user = User::find($userId);
        $resources = $user
            ->resources()
            ->published()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('resources.index', compact('resources', 'user'));
    }
}
