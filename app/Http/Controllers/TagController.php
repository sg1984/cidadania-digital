<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * TagController constructor.
     *
     * @return void|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function __construct()
    {
        if(!auth()->check()) {
            return redirect('/');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::query()
            ->orderBy('name')
            ->paginate(20);

        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->all(['name']);
        $storeData['is_active'] = $request->get('is_active') ? true : false;

        $tag = Tag::create($storeData);

        return redirect()->route('tags.index')->with('success', 'Tag salva com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $storeData = $request->all(['name']);
        $storeData['is_active'] = $request->get('is_active') ? true : false;

        $tag->update($storeData);

        return redirect()->route('tags.index')->with('success', 'Tag atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if(! $tag->canBeExcluded()) {
            return redirect()->route('tags.index')->with('error', 'A tag não pode ser removida pois existe conteúdo associada a ela!');
        }

        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Tag removida com sucesso!');
    }

    /**
     * Change the status of the tag
     *
     * @param int $tagId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus(int $tagId)
    {
        $tag = Tag::find($tagId);
        $new_is_active_status = ! $tag->is_active;
        $tag->update([
            'is_active' => $new_is_active_status
        ]);

        return redirect()->route('tags.index')->with('success', 'Status da tag atualizada com sucesso!');
    }
}
