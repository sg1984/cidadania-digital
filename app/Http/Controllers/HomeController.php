<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $resources = Resource::where('user_id',auth()->id())
            ->with('subject', 'user')
            ->get();

        return view('resources.index', compact('resources'));
    }
}
