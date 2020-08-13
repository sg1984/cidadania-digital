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
     * @param string $tab
     * @param string $status
     * @return Application|Factory|View
     */
    public function index(string $tab = Ticket::SLUG_TAB_ALL, string $status = Ticket::SLUG_STATUS_OPEN)
    {
        if(!auth()->check()) {
            return redirect('/');
        }

        $query = Ticket::query()
            ->byStatus([Ticket::SLUGS_STATUSES[$status]])
            ->with('responsible', 'createdBy');

        if ($tab === Ticket::SLUG_TAB_CREATED) {
            $query->byCreatedUser(auth()->user());
        }

        if ($tab === Ticket::SLUG_TAB_RECEIVED) {
            $query->byResponsibleUser(auth()->user());
        }

        $tickets = $query
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGINATE_SIZE);

        return view('tickets.index', compact('tickets', 'tab', 'status'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function bugReport(Request $request)
    {
        if(!auth()->check()) {
            return redirect('/');
        }

        return $this->createTicketToAdmin($request, Ticket::TYPE_SYSTEM_REPORT_BUG);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function helpRequest(Request $request)
    {
        if(!auth()->check()) {
            return redirect('/');
        }

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
        $this->sendEmail($ticket, $adminUser);

        return back()->with('success', 'Ticket criado com sucesso!');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function resourceReport(Request $request)
    {
        if(!auth()->check()) {
            return redirect('/');
        }

        $storeData = $request->all(['description', 'title', 'responsible_id', 'resource_id']);
        $storeData['ticket_type'] = Ticket::TYPE_REPORT_RESOURCE;
        $storeData['created_by'] = auth()->user()->id;
        $storeData['status'] = Ticket::STATUS_OPEN;

        $ticket = Ticket::create($storeData);
        $ticket->load(['responsible', 'resource']);
        $this->sendEmail($ticket);

        return back()->with('success', 'Ticket criado com sucesso!');
    }

    /**
     * @param Ticket    $ticket
     * @param User|null $user
     */
    private function sendEmail(Ticket $ticket, User $user = null) {
        if ($user) {
            $emailTo = $user->email;
        } else {
            $emailTo = $ticket->responsible->email;
        }

        Mail::to($emailTo)
            ->cc('sandrogallina1984@gmail.com')
            ->send(new ReportBug(auth()->user(), $ticket));
    }

    /**
     * Display the specified resource.
     *
     * @param Ticket $ticket
     * @return Application|Factory|View
     */
    public function show(Ticket $ticket)
    {
        if(!auth()->check()) {
            return redirect('/');
        }

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
        if(!auth()->check()) {
            return redirect('/');
        }

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
        if(!auth()->check()) {
            return redirect('/');
        }

        $ticket->load(['createdBy', 'responsible', 'comments.createdBy']);

        return view($blade, compact('ticket'));
    }

    /**
     * @param Ticket $ticket
     * @return Application|Factory|View
     */
    public function editOwner(Ticket $ticket)
    {
        if(!auth()->check()) {
            return redirect('/');
        }

        if (auth()->id() !== $ticket->createdBy){
            return $this->show($ticket);
        }

        return $this->edit($ticket, 'tickets.edit-owner');
    }

    /**
     * @param Ticket $ticket
     * @return Application|Factory|View
     */
    public function editResponsible(Ticket $ticket)
    {
        if(!auth()->check()) {
            return redirect('/');
        }

        return $this->edit($ticket, 'tickets.edit-responsible');
    }

    /**
     * @param Request $request
     * @param Ticket  $ticket
     * @return RedirectResponse
     */
    public function update(Request $request, Ticket $ticket)
    {
        if(!auth()->check()) {
            return redirect('/');
        }

        try {
            $newStatus = (int) $request->get('status');
            $newTitle = $request->get('title');
            $newDescription = $request->get('description');
            $storeData = [];
            if (is_numeric($newStatus)) {
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
