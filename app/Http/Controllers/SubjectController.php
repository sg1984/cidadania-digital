<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Tag;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * SubjectController constructor.
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
        $subjects = Subject::query()
            ->with('tags')
            ->orderBy('name')
            ->get();

        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::query()
            ->isActive()
            ->orderBy('name')
            ->get();

        return view('subjects.create', compact('tags'));
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
        $storeData['created_by'] = auth()->id();
        $storeData['is_active'] = $request->get('is_active') ? true : false;

        $subject = Subject::create($storeData);
        $subject->tags()->attach($request->get('tags'),[
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        return redirect()->route('subjects.index')->with('success', 'Verbete salvo com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $subject->load('tags');

        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $subject->load('tags');
        $tags = Tag::query()
            ->isActive()
            ->orderBy('name')
            ->get();

        return view('subjects.edit', compact('subject', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $storeData = $request->all(['name']);
        $storeData['is_active'] = $request->get('is_active') ? true : false;

        $oldTags = $subject->tags()->pluck('id');
        $subject->update($storeData);
        $subject->tags()->detach($oldTags);
        $subject->tags()->attach($request->get('tags'),[
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        return redirect()->route('subjects.index')->with('success', 'Verbete atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        if(! $subject->canBeExcluded()) {
            return redirect()->route('subjects.index')->with('error', 'A verbete não pode ser removida pois existe conteúdo associada a ela!');
        }

        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Verbete removida com sucesso!');

    }

    /**
     * Change the status of the tag
     *
     * @param int $subjectId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus(int $subjectId)
    {
        $subject = Subject::find($subjectId);
        $new_is_active_status = ! $subject->is_active;
        $subject->update([
            'is_active' => $new_is_active_status
        ]);

        return redirect()->route('subjects.index')->with('success', 'Status do verbete atualizado com sucesso!');
    }
}
