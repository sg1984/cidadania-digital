<?php

namespace App\Http\Controllers;

use App\Mail\ReportBug;
use App\Resource;
use App\Subject;
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
        $series = [
            [
                'title' => 'blockchain',
                'description' => 'Lorem ipsum dolor sit amet, csonsectetur adipiscing elit. Quisque sodales pulvinar odio, eget ultricies lacus venenatis nec. Pellentesque laoreet ultrices finibus. Aenean imperdiet leo eu semper sodales. Mauris volutpat eu ante a tempor. Nunc ac dolor sed orci lacinia imperdiet. Ut accumsan scelerisque purus eget pellentesque. Quisque nec luctus lorem.',
                'tags' => [
                    [
                        'id' => 1,
                        'name' => 'blockchain',
                    ],
                    [
                        'id' => 2,
                        'name' => 'blockchain',
                    ],
                    [
                        'id' => 3,
                        'name' => 'blockchain',
                    ],
                ],
                'thumbnail' => url('/images/series/blockchain.jpg'),
                'url' => route('showSpecialPage', Subject::BLOCKCHAIN_CIDADANIA_SERIE),
            ],
            [
                'title' => 'cidadaniaTerceiroMilênio',
                'description' => 'Lorem ipsum dolor sit amet, csonsectetur adipiscing elit. Quisque sodales pulvinar odio, eget ultricies lacus venenatis nec. Pellentesque laoreet ultrices finibus. Aenean imperdiet leo eu semper sodales. Mauris volutpat eu ante a tempor. Nunc ac dolor sed orci lacinia imperdiet. Ut accumsan scelerisque purus eget pellentesque. Quisque nec luctus lorem.',
                'tags' => [
                    [
                        'id' => 1,
                        'name' => 'cidadaniaTerceiroMilênio',
                    ],
                    [
                        'id' => 2,
                        'name' => 'cidadaniaTerceiroMilênio',
                    ],
                    [
                        'id' => 3,
                        'name' => 'cidadaniaTerceiroMilênio',
                    ],
                ],
                'thumbnail' => url('/images/series/cidadaniaTerceiroMilênio.jpg'),
                'url' => route('showSpecialPage', Subject::CIDADANIA_TERCEIRO_MILENIO),
            ],
            [
                'title' => 'codice',
                'description' => 'Lorem ipsum dolor sit amet, csonsectetur adipiscing elit. Quisque sodales pulvinar odio, eget ultricies lacus venenatis nec. Pellentesque laoreet ultrices finibus. Aenean imperdiet leo eu semper sodales. Mauris volutpat eu ante a tempor. Nunc ac dolor sed orci lacinia imperdiet. Ut accumsan scelerisque purus eget pellentesque. Quisque nec luctus lorem.',
                'tags' => [
                    [
                        'id' => 1,
                        'name' => 'codice',
                    ],
                    [
                        'id' => 2,
                        'name' => 'codice',
                    ],
                    [
                        'id' => 3,
                        'name' => 'codice',
                    ],
                ],
                'thumbnail' => url('/images/series/codice.jpg'),
                'url' => route('showSpecialPage', Subject::CODICE),
            ],
            [
                'title' => 'dataEcologiaMudançaClimática',
                'description' => 'Lorem ipsum dolor sit amet, csonsectetur adipiscing elit. Quisque sodales pulvinar odio, eget ultricies lacus venenatis nec. Pellentesque laoreet ultrices finibus. Aenean imperdiet leo eu semper sodales. Mauris volutpat eu ante a tempor. Nunc ac dolor sed orci lacinia imperdiet. Ut accumsan scelerisque purus eget pellentesque. Quisque nec luctus lorem.',
                'tags' => [
                    [
                        'id' => 1,
                        'name' => 'dataEcologiaMudançaClimática',
                    ],
                    [
                        'id' => 2,
                        'name' => 'dataEcologiaMudançaClimática',
                    ],
                    [
                        'id' => 3,
                        'name' => 'dataEcologiaMudançaClimática',
                    ],
                ],
                'thumbnail' => url('/images/series/dataEcologiaMudançaClimática.jpg'),
                'url' => route('showSpecialPage', Subject::DATA_ECOLOGIA_CLIMA),
            ],
            [
                'title' => 'direitoSaudeDigital',
                'description' => 'Lorem ipsum dolor sit amet, csonsectetur adipiscing elit. Quisque sodales pulvinar odio, eget ultricies lacus venenatis nec. Pellentesque laoreet ultrices finibus. Aenean imperdiet leo eu semper sodales. Mauris volutpat eu ante a tempor. Nunc ac dolor sed orci lacinia imperdiet. Ut accumsan scelerisque purus eget pellentesque. Quisque nec luctus lorem.',
                'tags' => [
                    [
                        'id' => 1,
                        'name' => 'direitoSaudeDigital',
                    ],
                    [
                        'id' => 2,
                        'name' => 'direitoSaudeDigital',
                    ],
                    [
                        'id' => 3,
                        'name' => 'direitoSaudeDigital',
                    ],
                ],
                'thumbnail' => url('/images/series/direitoSaudeDigital.jpg'),
                'url' => route('showSpecialPage', Subject::DIREITO_SAUDE_DIGITAL),
            ],
            [
                'title' => 'dialogosAtopicos',
                'description' => 'Lorem ipsum dolor sit amet, csonsectetur adipiscing elit. Quisque sodales pulvinar odio, eget ultricies lacus venenatis nec. Pellentesque laoreet ultrices finibus. Aenean imperdiet leo eu semper sodales. Mauris volutpat eu ante a tempor. Nunc ac dolor sed orci lacinia imperdiet. Ut accumsan scelerisque purus eget pellentesque. Quisque nec luctus lorem.',
                'tags' => [
                    [
                        'id' => 1,
                        'name' => 'diálogosAtopicos',
                    ],
                    [
                        'id' => 2,
                        'name' => 'diálogosAtopicos',
                    ],
                    [
                        'id' => 3,
                        'name' => 'diálogosAtopicos',
                    ],
                ],
                'thumbnail' => url('/images/series/dialogos-atopicos.jpg'),
                'url' => route('showSpecialPage', Subject::DIALOGOS_ATOPICOS),
            ],
        ];

        $subjects = array_filter(
            Subject::SUBJECT_NAMES_IMAGES,
            function ($subject) {
                return strpos($subject['image'], 'subjects') > 0;
            }
        );

        $partners = [
            url('/images/logos/avatar_jornalismos.png'),
            url('/images/logos/logo_fakenews.png'),
            url('/images/logos/logo_gped.png'),
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
