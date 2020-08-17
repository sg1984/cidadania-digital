<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
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
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function create()
    {
        if(!auth()->check()) {
            return redirect('/');
        }

        $tags = Tag::query()
            ->isActive()
            ->orderBy('name')
            ->get();

        return view('subjects.create', compact('tags'));
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        if(!auth()->check()) {
            return redirect('/');
        }

        $storeData = $request->all(['name']);
        $storeData['created_by'] = auth()->id();
        $storeData['is_active'] = $request->get('is_active') ? true : false;
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

        $subject = Subject::create($storeData);
        $subject->tags()->attach($tagsToAttach,[
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        return redirect()->route('subjects.index')->with('success', 'Verbete salvo com sucesso');
    }

    /**
     * @param Subject $subject
     * @return Application|Factory|View
     */
    public function show(Subject $subject)
    {
        $subject->load('tags');

        return view('subjects.show', compact('subject'));
    }

    /**
     * @param Subject $subject
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function edit(Subject $subject)
    {
        if(!auth()->check()) {
            return redirect('/');
        }

        $subject->load('tags');
        $tags = Tag::query()
            ->isActive()
            ->orderBy('name')
            ->get();

        return view('subjects.edit', compact('subject', 'tags'));
    }

    /**
     * @param Request $request
     * @param Subject $subject
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, Subject $subject)
    {
        if(!auth()->check()) {
            return redirect('/');
        }

        $storeData = $request->all(['name']);
        $storeData['is_active'] = $request->get('is_active') ? true : false;

        $oldTags = $subject->tags()->pluck('id');
        $subject->update($storeData);
        $subject->tags()->detach($oldTags);

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

        $subject->tags()->attach($tagsToAttach,[
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        return redirect()->route('subjects.index')->with('success', 'Verbete atualizado com sucesso');
    }

    /**
     * @param Subject $subject
     * @return Application|RedirectResponse|Redirector
     * @throws \Exception
     */
    public function destroy(Subject $subject)
    {
        if(!auth()->check()) {
            return redirect('/');
        }

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
     * @return RedirectResponse
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
