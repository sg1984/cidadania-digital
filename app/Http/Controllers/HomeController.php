<?php

namespace App\Http\Controllers;

use App\Mail\ReportBug;
use App\Resource;
use App\Subject;
use App\Tag;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param $SUBJECT_NAMES_IMAGES
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $series = [];
        foreach (Subject::SERIES_PAGES as $seriesId => $seriesData){
            $series[] = [
                'id' => $seriesId,
                'description' => $seriesData['description'],
                'tags' => Tag::byIds($seriesData['tags_ids'])->get(),
                'thumbnail' => url($seriesData['thumbnail']),
                'url' => route('showSpecialPage', $seriesId),
            ];
        }

        $subjects = array_filter(
            Subject::SUBJECT_NAMES_IMAGES,
            function ($subject) {
                return strpos($subject['image'], 'subjects') > 0;
            }
        );

        $partners = [
            url('/images/logos/logo_atopos.png'),
            url('/images/logos/avatar_jornalismos.png'),
            url('/images/logos/logo_fakenews.png'),
            url('/images/logos/logo_gped.png'),
            url('/images/logos/logo_fapcom.png'),
        ];

        return view('home', compact('subjects', 'series', 'partners'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        if (!auth()->check()){
            return redirect('/');
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
        return view('pages.about');
    }

    public function team()
    {
        $coordinators = [
            'title' => 'Coordenador Científico',
            'people' => User::getCoordinators()
        ];

        $researchers = [
                'title' => 'Professores e Pesquisadores',
                'people' => User::getResearchers(),
            ];
        $designers = [
                'title' => 'UI/UX Designer',
                'people' => User::getDesigners(),
            ];
        $developers = [
                'title' => 'Desenvolvedor Full-stack',
                'people' => User::getDevelopers(),
            ];
        return view('pages.team', compact('coordinators', 'researchers', 'designers', 'developers'));
    }
}
