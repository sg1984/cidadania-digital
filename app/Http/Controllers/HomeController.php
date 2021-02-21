<?php

namespace App\Http\Controllers;

use App\Mail\ReportBug;
use App\Resource;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $contentDirectoryVideosData = [
            ['videoTitle' => 'Cidadania do terceiro milênio: a cidadania biosférica', 'idVideo' => '6f4PibNwpNk'],
            ['videoTitle' => 'Cidadania do terceiro milênio: a cidadania das galáxias', 'idVideo' => 'oOlZj8kscVI'],
            ['videoTitle' => 'Cidadania Terceiro Milênio: A info-cidadania', 'idVideo' => 'asd7GIoxz_A']
        ];
        $wikiCidadaniaVideosData = [
            ['videoTitle' => 'Verbete Algoritmos para cidadania', 'idVideo' => 'v3fjnBDDjvQ'],
            ['videoTitle' => 'Verbete Ecologia da informação: big data, fake news e mundos possíveis', 'idVideo' => 'oKINxlw6mMA'],
            ['videoTitle' => 'Verbete Green Data, Ecologia e Mudanças Climáticas', 'idVideo' => 'DUFjMrIC1Is'],
            ['videoTitle' => 'Verbete: E-government e governança digital', 'idVideo' => 'wRSy08pNOSk'],
            ['videoTitle' => 'Verbete: Transliteracia para cidadania digital', 'idVideo' => 'vks7jfUt2ic'],
            ['videoTitle' => 'Verbete Games para a cidadania digital', 'idVideo' => 'iLQfTFIs7DE'],
        ];

        return view('home', compact('contentDirectoryVideosData', 'wikiCidadaniaVideosData'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        if (!auth()->check()){
            return redirect('/');
        }

        if (auth()->user()->is_admin){
            return redirect('/users');
        }
        $tickets = Ticket::query()
            ->byResponsibleUser(auth()->user())
            ->byStatus([Ticket::STATUS_OPEN, Ticket::STATUS_IN_PROGRESS])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $resources = Resource::where('created_by',auth()->id())
            ->with('subject', 'user')
            ->paginate(20);

        return view('resources.index', compact('resources', 'tickets'));
    }

    public function bugReport(Request $request)
    {
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->cc('sandrogallina1984@gmail.com')
            ->send(new ReportBug(auth()->user(), 'Erro', $request->get('description')));

        return back();
    }

    public function helpRequest(Request $request)
    {
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->cc('sandrogallina1984@gmail.com')
            ->send(new ReportBug(auth()->user(), 'Ajuda', $request->get('description')));

        return back();
    }

    public function about()
    {
        return view('resources.about');
    }
}
