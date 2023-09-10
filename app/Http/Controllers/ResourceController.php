<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Subject;
use App\Tag;
use App\Ticket;
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
     * Display a listing of the resource.
     *
     * @return RedirectResponse
     */
    public function index()
    {
        return redirect()->route('home');
    }

    /**
     * @return Application|Factory|RedirectResponse|View
     */
    public function create()
    {
        if(is_null(auth()->id()) || !auth()->check()) {
            return redirect()->to('home');
        }

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
        if(is_null(auth()->id()) || !auth()->check()) {
            return redirect()->to('home');
        }

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

            $tags = $request->get('tags');
            $tagsToAttach = [];
            foreach ($tags as $tag) {
                if (is_numeric($tag)){
                    $tagsToAttach[] = $tag;
                } else {
                    $storeTagData['name'] = trim($tag);
                    $storeTagData['is_active'] = true;
                    $newTag = Tag::findOrCreate($storeTagData);
                    $tagsToAttach[] = $newTag->id;
                }
            }

            $resource->tags()->attach($tagsToAttach, [
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]);
            if ($fileMetadata) {
                $resource->uploadedFile()->save($fileMetadata);
            }
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['Erro ao salvar o documento, favor tentar novamente. Erro: ' . $e->getMessage()]);
        }

        return redirect()->route('home')->with('success', 'Documento salvo com sucesso');
    }

    /**
     * @param Resource $resource
     * @return Application|Factory|View
     */
    public function show(Resource $resource)
    {
        return view('resources.show', compact('resource'));
    }

    /**
     * @param Resource $resource
     * @return Application|Factory|RedirectResponse|View
     */
    public function edit(Resource $resource)
    {
        if(is_null(auth()->id()) || !auth()->check()) {
            return redirect()->to('home');
        }

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
        if(is_null(auth()->id()) || !auth()->check()) {
            return redirect()->to('home');
        }

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

            $tags = $request->get('tags');
            $tagsToAttach = [];
            foreach ($tags as $tag) {
                if (is_numeric($tag)){
                    $tagsToAttach[] = $tag;
                } else {
                    $storeTagData['name'] = trim($tag);
                    $storeTagData['is_active'] = true;
                    $newTag = Tag::findOrCreate($storeTagData);
                    $tagsToAttach[] = $newTag->id;
                }
            }


            $resource->tags()->attach($tagsToAttach, [
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

        return redirect()->route('home')->with('success', 'Documento atualizado com sucesso');
    }

    /**
     * @param Resource $resource
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Resource $resource)
    {
        if(is_null(auth()->id()) || !auth()->check()) {
            return redirect()->to('home');
        }

        $resource->delete();

        return redirect()->route('resources.index')->with('success', 'Documento apagado com sucesso!');
    }

    /**
     * @param int $tagId
     * @return Factory|View
     */
    public function searchByTag(int $tagId, bool $newVersion = false)
    {
        $tag = Tag::find($tagId);
        $searchBy = $tag->name;
        $resources = $tag
            ->resources()
            ->published()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $viewName = $newVersion ? 'v2.resources.contents' : 'resources.contents';

        return view($viewName, compact('resources', 'searchBy'));
    }

    public function searchByTagV2(int $tagId)
    {
        return $this->searchByTag($tagId, true);
    }

    /**
     * @param int $subjectId
     * @return Factory|View
     */
    public function searchBySubject(int $subjectId, bool $newVersion = false)
    {
        $subject = Subject::find($subjectId);
        $searchBy = $subject->name;
        $resources = $subject->resources()
            ->published()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $viewName = $newVersion ? 'v2.resources.contents' : 'resources.contents';

        return view($viewName, compact('resources', 'searchBy'));
    }

    public function searchBySubjectV2(int $subjectId)
    {
        return $this->searchBySubject($subjectId, true);
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
    public function showAll(Request $request, bool $newVersion = false)
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
        $resources->appends(['search' => $searchRequest]);

        $viewName = $newVersion ? 'v2.resources.contents' : 'resources.contents';

        return view($viewName, compact('resources', 'searchBy'));
    }

    public function showAllV2(Request $request)
    {
        return $this->showAll($request, true);
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

    public function showByUserV2(string $userSlug)
    {
        $userId = null;
        $userData = null;
        foreach (User::MAP_ID_USER as $id => $user) {
            if ($userSlug === User::getSlugFrom($user['name'])) {
                $userId = $id;
                $userData = $user;
                break;
            }
        }

        $user = User::find($userId);
        $resources = collect([]);
        if ($user) {
            $resources = $user
                ->resources()
                ->published()
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }

        $searchBy = $user ? $user->name : $userSlug;

        return view('v2.resources.contents',
            compact('resources', 'searchBy', 'userData'));
    }
}
