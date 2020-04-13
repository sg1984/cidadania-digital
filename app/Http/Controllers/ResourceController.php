<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Subject;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Resource::where('user_id',auth()->id())
            ->with('subject')
            ->get();

        return view('resources.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->check()) {
            return redirect('/resources');
        }

        $subjects = Subject::all();

        return view('resources.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->check()) {
            return redirect('/resources');
        }

        $storeData = $request->all([
            'title', 'key_words', 'description', 'format', 'source', 'subject_id'
        ]);
        $storeData['user_id'] = auth()->id();
        Resource::create($storeData);

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
        $subjects = Subject::all();

        return view('resources.edit', compact('resource', 'subjects'));
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
        if(!auth()->check()) {
            return redirect('/resources');
        }

        $storeData = $request->all([
            'title', 'key_words', 'description', 'format', 'source', 'subject_id'
        ]);
        $resource->update($storeData);

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
        if(!auth()->check()) {
            return redirect('/resources');
        }

        $resource->delete();

        return redirect()->route('resources.index')->with('success', 'Documento apagado com sucesso!');
    }
}
