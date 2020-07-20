<?php

namespace App\Http\Controllers;

use App\Mail\ReportBug;
use App\Ticket;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * TicketController constructor.
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
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $tab = Ticket::TAB_TICKETS_ALL;
        $tickets = Ticket::query()
            ->with('responsible', 'createdBy')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('tickets.index', compact('tickets', 'tab'));
    }

    /**
     * Display a listing of tickets created by the logged user.
     *
     * @return Application|Factory|View
     */
    public function myCreatedTickets()
    {
        $tab = Ticket::TAB_TICKETS_SENT;
        $tickets = Ticket::query()
            ->byCreatedUser(auth()->user())
            ->with('responsible', 'createdBy')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('tickets.index', compact('tickets', 'tab'));
    }

    /**
     * Display a listing of tickets received by the logged user.
     *
     * @return Application|Factory|View
     */
    public function myReceivedTickets()
    {
        $tab = Ticket::TAB_TICKETS_RECEIVED;
        $tickets = Ticket::query()
            ->byResponsibleUser(auth()->user())
            ->with('responsible', 'createdBy')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('tickets.index', compact('tickets', 'tab'));
    }

    public function bugReport(Request $request)
    {
        $storeData = $request->all(['description']);
        $storeData['title'] = 'Erro no sistema';
        $storeData['ticket_type'] = Ticket::TYPE_SYSTEM_REPORT_BUG;
        $storeData['created_by'] = auth()->user()->id;
        $storeData['responsible_id'] = User::getAdminUser()->id;
        $storeData['status'] = Ticket::STATUS_OPEN;

        $ticket = Ticket::create($storeData);

        dd($ticket);

//        Mail::to(env('MAIL_FROM_ADDRESS'))
//            ->cc('sandrogallina1984@gmail.com')
//            ->send(new ReportBug(auth()->user(), 'Erro', $request->get('description')));

//        return back();
    }

    public function helpRequest(Request $request)
    {
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->cc('sandrogallina1984@gmail.com')
            ->send(new ReportBug(auth()->user(), 'Ajuda', $request->get('description')));

        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
