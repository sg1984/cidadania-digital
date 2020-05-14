<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $resources = Resource::with('subject', 'user', 'tags')
            ->published()
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('home', compact('resources'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        if (!auth()->check()){
            return redirect('/');
        }

        $resources = Resource::where('created_by',auth()->id())
            ->with('subject', 'user')
            ->paginate(20);

        return view('resources.index', compact('resources'));
    }
}
