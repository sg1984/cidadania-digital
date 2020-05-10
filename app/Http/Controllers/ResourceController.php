<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Subject;
use App\Tag;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * ResourceController constructor.
     *
     * @return void|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $userSubjects = auth()->user()->isAdmin() ? Subject::all() : auth()->user()->subjects;
        $formats = Resource::FORMAT_TYPES;

        return view('resources.create', compact('tags', 'userSubjects', 'formats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->all([
            'title', 'author', 'key_words', 'description', 'publisher',
            'source', 'format_id', 'language', 'subject_id',
        ]);
        $storeData['created_by'] = auth()->id();
        $resource = Resource::create($storeData);
        $resource->tags()->attach($request->get('tags'),[
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        return redirect()->route('resources.index')->with('success', 'Documento salvo com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource)
    {
        return view('resources.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        $tags = Tag::all();
        $userSubjects = auth()->user()->isAdmin() ? Subject::all() : auth()->user()->subjects;
        $formats = Resource::FORMAT_TYPES;

        return view('resources.edit', compact('resource', 'userSubjects', 'tags', 'formats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resource $resource)
    {
        $storeData = $request->all([
            'title', 'author', 'key_words', 'description', 'publisher',
            'source', 'format_id', 'language', 'subject_id',
        ]);
        $storeData['created_by'] = auth()->id();

        $oldTags = $resource->tags()->pluck('id');
        $resource->update($storeData);
        $resource->tags()->detach($oldTags);
        $resource->tags()->attach($request->get('tags'),[
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        return redirect()->route('resources.index')->with('success', 'Documento atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Resource $resource
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Resource $resource)
    {
        $resource->delete();

        return redirect()->route('resources.index')->with('success', 'Documento apagado com sucesso!');
    }

    /**
     * @param int $tagId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchByTag(int $tagId)
    {
        $tag = Tag::find($tagId);
        $searchBy = $tag->name;
        $resources = $tag->resources()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('resources.contents', compact('resources', 'searchBy'));
    }

    /**
     * @param int $subjectId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchBySubject(int $subjectId)
    {
        $subject = Subject::find($subjectId);
        $searchBy = $subject->name;
        $resources = $subject->resources()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('resources.contents', compact('resources', 'searchBy'));
    }

    /**
     * @param int $subjectId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchByFormat(int $typeId)
    {
        $searchBy = Resource::FORMAT_TYPES[$typeId];
        $resources = Resource::where('format_id', $typeId)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('resources.contents', compact('resources', 'searchBy'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAll()
    {
        $searchBy = 'Tudo';
        $resources = Resource::orderBy('created_at', 'desc')
            ->paginate(20);

        return view('resources.contents', compact('resources', 'searchBy'));
    }
}
