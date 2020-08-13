<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class TagController extends Controller
{
    /**
     * TagController constructor.
     *
     * @return void|Redirector|RedirectResponse
     */
    public function __construct()
    {
        if(!auth()->check()) {
            return redirect('/');
        }
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $tags = Tag::query()
            ->orderBy('name')
            ->get();

        return view('tags.index', compact('tags'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $tagsToStore = explode(';', $request->get('name'));
        $savedTags = 0;
        foreach ($tagsToStore as $tagName) {
            if($tagName){
                $storeData['name'] = trim($tagName);
                $storeData['is_active'] = $request->get('is_active') ? true : false;
                Tag::create($storeData);
                $savedTags++;
            }
        }

        if ($savedTags && $savedTags > 0) {
            return redirect()->route('tags.index')->with('success', 'Foram salvas ' . $savedTags . ' tag(s).');
        }

        return back()->withInput()->withErrors(['Erro ao salvar as tags, favor tentar novamente!']);
    }

    /**
     * @param Tag $tag
     * @return Application|Factory|View
     */
    public function show(Tag $tag)
    {
        return view('tags.show', compact('tag'));
    }

    /**
     * @param Tag $tag
     * @return Application|Factory|View
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * @param Request $request
     * @param Tag     $tag
     * @return RedirectResponse
     */
    public function update(Request $request, Tag $tag)
    {
        $storeData = $request->all(['name']);
        $storeData['is_active'] = $request->get('is_active') ? true : false;

        $tag->update($storeData);

        return redirect()->route('tags.index')->with('success', 'Tag atualizada com sucesso');
    }

    /**
     * @param Tag $tag
     * @return RedirectResponse
     * @throws \Exception
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
     * @return RedirectResponse
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
