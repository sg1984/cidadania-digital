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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $series = [];
        foreach (Subject::SERIES_PAGES as $seriesId => $seriesData){
            if ($seriesId === Subject::UNICO) {
                continue;
            }
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
            url('/images/logos/fapcom-logo.png'),
            url('/images/logos/jornalismos-logo.png'),
            url('/images/logos/fake-news-logo.png'),
            url('/images/logos/gpe-du-logo.png'),
        ];

        return view('home', compact('subjects', 'series', 'partners'));
    }

    public function indexV2()
    {
        $series = [];
        $tagsToShow = [];
        foreach (Subject::SERIES_PAGES as $seriesId => $seriesData){
            if ($seriesId === Subject::UNICO) {
                continue;
            }

            $tags = Tag::byIds($seriesData['tags_ids'])->get();
            $tagsToShow += $tags->toArray();

            $series[] = [
                'id' => $seriesId,
                'title' => $seriesData['title'],
                'description' => $seriesData['description'],
                'tags' => $tags,
                'thumbnail' => url($seriesData['thumbnail-novo'] ?? $seriesData['thumbnail']),
                'url' => route('v2.showSpecialPage', $seriesId),
            ];
        }

        $subjects = array_filter(
            Subject::SUBJECT_NAMES_IMAGES,
            function ($subject) {
                return strpos($subject['image'], 'subjects') > 0;
            }
        );

        $partners = [
            url('/images/logos/fapcom-logo-gray.png'),
            url('/images/logos/jornalismos-logo-gray.png'),
            url('/images/logos/fake-news-logo-gray.png'),
            url('/images/logos/gpe-du-logo-gray.png'),
        ];

        $masterclasses = [
            [
                'title' => 'Masterclass Unico - Curso',
                'url' => route('v2.showSpecialPage', 'unico'),
                'thumbnail' => '/images/masterclasses/banner-1-web.png',
                'thumbnail-tablet' => '/images/masterclasses/banner-1-tablet.png',
                'thumbnail-mobile' => '/images/masterclasses/banner-1-mobile.png',
            ],
            [
                'title' => 'Masterclass 1 - Identidades digitais não-humanas',
                'url' => route('v2.showSpecialPage', 'unico') . '#xPSBviVQ0d8',
                'thumbnail' => '/images/masterclasses/banner-2-web.png',
                'thumbnail-tablet' => '/images/masterclasses/banner-2-tablet.png',
                'thumbnail-mobile' => '/images/masterclasses/banner-2-mobile.png',
            ],
            [
                'title' => 'Masterclass 2 - Digital Twins: A Identidade na Época do Onlife',
                'url' => route('v2.showSpecialPage', 'unico') . '#nLEF7PrvqLc',
                'thumbnail' => '/images/masterclasses/banner-3-web.png',
                'thumbnail-tablet' => '/images/masterclasses/banner-3-tablet.png',
                'thumbnail-mobile' => '/images/masterclasses/banner-3-mobile.png',
            ],
            [
                'title' => 'Masterclass 3 - Privacidade e Open Data',
                'url' => route('v2.showSpecialPage', 'unico') . '#J1blB3gLFbc',
                'thumbnail' => '/images/masterclasses/banner-4-web.png',
                'thumbnail-tablet' => '/images/masterclasses/banner-4-tablet.png',
                'thumbnail-mobile' => '/images/masterclasses/banner-4-mobile.png',
            ],
            [
                'title' => 'Masterclass 4 - As Identidades Indígenas nas Redes Digitais',
                'url' => route('v2.showSpecialPage', 'unico') . '#wPcGA_PWGig',
                'thumbnail' => '/images/masterclasses/banner-5-web.png',
                'thumbnail-tablet' => '/images/masterclasses/banner-5-tablet.png',
                'thumbnail-mobile' => '/images/masterclasses/banner-5-mobile.png',
            ],
            [
                'title' => 'Masterclass 5 - Liderança Indígena: Conexão entre Povos e Eiversidade na Era Digital',
                'url' => route('v2.showSpecialPage', 'unico') . '#9vAX6CrA8m4',
                'thumbnail' => '/images/masterclasses/banner-6-web.png',
                'thumbnail-tablet' => '/images/masterclasses/banner-6-tablet.png',
                'thumbnail-mobile' => '/images/masterclasses/banner-6-mobile.png',
            ],
        ];

        return view('v2/home',
            compact(
                'subjects',
                'series',
                'partners',
                'tagsToShow',
                'masterclasses'
            )
        );
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

    public function aboutV2()
    {
        $coordinators = [
            'title' => 'Coordenador Científico',
            'people' => User::getCoordinators()
        ];

        $researchers = [
            'title' => 'Professores e Pesquisadores',
            'people' => User::getResearchers(),
        ];

        $invitedResearchers = [
            'title' => 'Atopos Internacional',
            'people' => User::getInvitedResearchers(),
        ];

        $researchers = [
            'title' => 'Demais integrantes',
            'people' => array_merge($researchers['people'], $invitedResearchers['people']),
        ];

        return view('v2.pages.about', compact('researchers', 'coordinators'));
    }

    public function team(bool $newVersion = false)
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
        $invitedResearchers = [
            'title' => 'Atopos Internacional',
            'people' => User::getInvitedResearchers(),
        ];

        if ($newVersion) {
            $researchers = [
                'title' => 'Professores e Pesquisadores',
                'people' => array_merge($researchers['people'], $invitedResearchers['people']),
            ];

            return view('v2.pages.team', compact('researchers', 'coordinators'));
        }

        return view('pages.team', compact('coordinators', 'researchers', 'designers', 'developers', 'invitedResearchers'));
    }

    public function teamV2()
    {
        return $this->team(true);
    }


    public function landingPage()
    {
        return view('lp');
    }
}
