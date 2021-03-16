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
        $homeVideos = [
            'Cidadania do terceiro milênio' => [
                ['videoTitle' => 'APRESENTAÇÃO por Massimo Di Felice', 'idVideo' => 'b58fYpvCsE4'],
                ['videoTitle' => 'EP.01 – A CIDADANIA BIOSFÉRICA por Antonio Donato Nobre (INPE)', 'idVideo' => 'iyQ7pKNqJfc'],
                ['videoTitle' => 'EP.02 – A CIDADANIA DAS GALÁXIAS por Amâncio Friaça (USP)', 'idVideo' => '0Vg6CvpfZ7U'],
                ['videoTitle' => 'EP.03 – ECOSOFIA por Michel Maffesoli', 'idVideo' => 'eKlVihKJeXE'],
            ],
            'Diálogos Atópicos' => [
                ['videoTitle' => 'EP.01 – O VÍRUS por João Pessoa Araújo Junior (UNESP)', 'idVideo' => '5S_3LBnYl7s'],
                ['videoTitle' => 'EP.02 – OS ALGORITMOS NA PANDEMIA por Mario Pireddu', 'idVideo' => 'mLFd8xrT60M'],
                ['videoTitle' => 'EP.03 – PANDEMIA E DIGITALIZAÇÃO DO NOSSO CORPO SOCIAL por Derick de Kerckhove', 'idVideo' => 'Yk1lhFnsuAo'],
                ['videoTitle' => 'EP.04 – BLOCKCHAIN E PANDEMIA por Tatiana Revoredo', 'idVideo' => '2ElaKe7DEeM'],
                ['videoTitle' => 'EP.05 – ESPECIAL EAD com Eliane Schlemmer', 'idVideo' => 'S9UgRgOWGIU'],
                ['videoTitle' => 'EP.06 – SIMPOIESE AMERÍNDIA por Thiago Franco', 'idVideo' => 'rWES2BjGdqo'],
                ['videoTitle' => 'EP.07 – Fake news e pandemia Prof Teresa Neves UFJF 1', 'idVideo' => '9Ev5BV05EZQ'],
            ],
            'Direito à Saúde Digital' => [
                ['videoTitle' => 'EP.01 – por Silvia Surrenti (Un. de Firence, ITA)', 'idVideo' => 'iw8feq27fPA'],
                ['videoTitle' => 'EP.02 – por Silvia Surrenti (Un. de Firence, ITA)', 'idVideo' => 'QMZJKxepynI'],
                ['videoTitle' => 'EP.03 – por Silvia Surrenti (Un. de Firence, ITA)', 'idVideo' => 'cRJQz0jcmAg'],
            ],
            'Wikicidadania' => [
                ['videoTitle' => 'APRESENTAÇÃO por Matheus Soares', 'idVideo' => 'r1zOmApdgJA'],
                ['videoTitle' => 'EP.01 – FOGO CRUZADO por Gabrielli Thomaz', 'idVideo' => 'EqOIzehhUdk'],
                ['videoTitle' => 'EP.02 – La storia del MoVimento 5 Stelle, raccontata da Davide Casaleggio', 'idVideo' => 'N3nJUMmb6TY'],
                ['videoTitle' => 'EP.03 – Pluvi.On - Prêmio Folha Empreendedor Social', 'idVideo' => '6bjeHsWtMww'],
                ['videoTitle' => 'EP.04 – LiquidFeedback 4.0 · Introduction (English)', 'idVideo' => 'y0e9_-IeRt8'],
                ['videoTitle' => 'EP.05 – Iniciativa MapBiomas', 'idVideo' => 'QmwI5b8aTSg'],
            ],
            'Codice: inovação digital com Barbara Carfagna' => [
                ['videoTitle' => 'EP.01 – Intervista ad Audrey Tang - Codice, La vita è digitale', 'idVideo' => 'D_IZVQysitc'],
                ['videoTitle' => 'EP.02 – Intervista a Jacqueline Poh - Codice, La vita è digitale', 'idVideo' => 'xNCa9w51WBM'],
                ['videoTitle' => 'EP.03 – Intervista a Hiroshi Ishiguro - Codice, La vita è digitale', 'idVideo' => 'RYpjvtXzWTE'],
                ['videoTitle' => 'EP.04 – Denaro "liquido?" - Codice, La vita è digitale', 'idVideo' => '4Bu0VsxzBF4'],
                ['videoTitle' => 'EP.05 – Intervista a Sangeet Choudary - Codice, La vita è digitale', 'idVideo' => 'V8ktpgxd77A'],
                ['videoTitle' => 'EP.06 – Intervista a Martin Sorrell - Codice, La vita è digitale', 'idVideo' => 'W1fReWh6WH0'],
            ],
            'Green Data, Ecologia e Mudanças Climáticas' => [
                ['videoTitle' => 'EP.01 – Verbete Green Data, Ecologia e Mudanças Climáticas', 'idVideo' => 'DUFjMrIC1Is'],
                ['videoTitle' => 'EP.02 – Beautiful Minds - James Lovelock - The Gaia Hypothesis / Gaia Theory', 'idVideo' => 'QqwZJDEZ9Ng'],
                ['videoTitle' => 'EP.03 – Como árvores conversam entre si por uma rede subterrânea', 'idVideo' => 'UirW2aBP-PY'],
                ['videoTitle' => 'EP.04 – How trees talk to each other | Suzanne Simard', 'idVideo' => 'Un2yBgIAxYs'],
                ['videoTitle' => 'EP.05 – Are plants conscious? | Stefano Mancuso | TEDxGranVíaSalon', 'idVideo' => 'gBGt5OeAQFk'],
                ['videoTitle' => 'EP.06 – Rios Voadores Parte I - A Dança da Chuva - Antonio Nobre/INPE', 'idVideo' => 'JDdvd-XC_sI'],
                ['videoTitle' => 'EP.07 – EYES IN THE FOREST: Saving Wildlife in Colombia Using Camera Traps and AI', 'idVideo' => 'zsiTx5qjn7c'],
                ['videoTitle' => 'EP.08 – Roleta Russa Climática', 'idVideo' => 'DSl-9OA_jNo'],
                ['videoTitle' => 'EP.09 – Drones for mapping invasive species in Patagonia', 'idVideo' => '6-x8VMK8fPo'],
            ],
        ];

        return view('home', compact('homeVideos'));
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
        return view('pages.team');
    }
}
