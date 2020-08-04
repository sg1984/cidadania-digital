<?php

namespace App\Http\Controllers;

use App\Mail\ReportBug;
use App\Resource;
use App\Ticket;
use App\TicketComment;
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
    private const PAGINATE_SIZE = 20;

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
            ->paginate(self::PAGINATE_SIZE);

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
            ->paginate(self::PAGINATE_SIZE);

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
            ->paginate(self::PAGINATE_SIZE);

        return view('tickets.index', compact('tickets', 'tab'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function bugReport(Request $request)
    {
        return $this->createTicketToAdmin($request, Ticket::TYPE_SYSTEM_REPORT_BUG);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function helpRequest(Request $request)
    {
        return $this->createTicketToAdmin($request, Ticket::TYPE_HELP);
    }

    /**
     * @param Request $request
     * @param int     $ticketType
     * @return RedirectResponse
     */
    private function createTicketToAdmin(Request $request, int $ticketType) {
        $adminUser = User::getAdminUser();
        $storeData = $request->all(['description', 'title']);
        $storeData['ticket_type'] = $ticketType;
        $storeData['created_by'] = auth()->user()->id;
        $storeData['responsible_id'] = $adminUser->id;
        $storeData['status'] = Ticket::STATUS_OPEN;

        $ticket = Ticket::create($storeData);
        $ticket->load(['responsible', 'resource']);

        Mail::to($adminUser->email)
            ->cc('sandrogallina1984@gmail.com')
            ->send(new ReportBug(auth()->user(), $ticket));

        return back()->with('success', 'Ticket criado com sucesso!');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function resourceReport(Request $request)
    {
        $storeData = $request->all(['description', 'title', 'responsible_id', 'resource_id']);
        $storeData['ticket_type'] = Ticket::TYPE_REPORT_RESOURCE;
        $storeData['created_by'] = auth()->user()->id;
        $storeData['status'] = Ticket::STATUS_OPEN;

        $ticket = Ticket::create($storeData);
        $ticket->load(['responsible', 'resource']);

        Mail::to($ticket->responsible->email)
            ->cc('sandrogallina1984@gmail.com')
            ->send(new ReportBug(auth()->user(), $ticket));

        return back()->with('success', 'Ticket criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param Ticket $ticket
     * @return Application|Factory|View
     */
    public function show(Ticket $ticket)
    {
        $ticket->load(['createdBy', 'responsible', 'comments.createdBy', 'resource']);

        return view('tickets.show', compact('ticket'));
    }

    /**
     * @param Request $request
     * @param Ticket  $ticket
     * @return RedirectResponse
     */
    public function addComment(Request $request, Ticket $ticket)
    {
        $comment = new TicketComment([
            'description' => $request->get('description'),
            'comment_type' => TicketComment::TYPE_USER_COMMENT,
            'created_by' => auth()->id(),
        ]);

        $ticket->comments()->save($comment);

        return back()->with('success', 'Comentário incluído com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Ticket $ticket
     * @param string $blade
     * @return Application|Factory|View
     */
    public function edit(Ticket $ticket, string $blade)
    {
        $ticket->load(['createdBy', 'responsible', 'comments.createdBy']);

        return view($blade, compact('ticket'));
    }

    /**
     * @param Ticket $ticket
     * @return Application|Factory|View
     */
    public function editOwner(Ticket $ticket)
    {
        return $this->edit($ticket, 'tickets.edit-owner');
    }

    /**
     * @param Ticket $ticket
     * @return Application|Factory|View
     */
    public function editResponsible(Ticket $ticket)
    {
        return $this->edit($ticket, 'tickets.edit-responsible');
    }

    /**
     * @param Request $request
     * @param Ticket  $ticket
     * @return RedirectResponse
     */
    public function update(Request $request, Ticket $ticket)
    {
        try {
            $newStatus = $request->get('status');
            $newTitle = $request->get('title');
            $newDescription = $request->get('description');
            $storeData = [];
            if ($newStatus) {
                $storeData['status'] = $newStatus;
                $comment = new TicketComment([
                    'description' => 'Mudou o status do ticket de "' . $ticket->getStatusText() . '" para "' . Ticket::STATUSES_TEXTS[$newStatus] . '"',
                    'comment_type' => TicketComment::TYPE_SYSTEM_COMMENT,
                    'created_by' => auth()->id(),
                ]);

                $ticket->comments()->save($comment);

            }
            if ($newTitle) {
                $storeData['title'] = $newTitle;
            }
            if ($newDescription) {
                $storeData['description'] = $newDescription;
            }
            if (!empty($storeData)) {
                $storeData['updated_by'] = auth()->id();
                $ticket->update($storeData);
            }

            return back()->with('success', 'Ticket atualizado com sucesso');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['Erro ao atualizar o ticket, favor tentar novamente. Erro: ' . $e->getMessage()]);
        }
    }
}
