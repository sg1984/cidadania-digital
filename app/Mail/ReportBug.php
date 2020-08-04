<?php

namespace App\Mail;

use App\Ticket;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportBug extends Mailable
{
    use Queueable, SerializesModels;

    private const TYPE_VIEW_MAPPING = [
        Ticket::TYPE_SYSTEM_REPORT_BUG => 'mail.mail-contact',
        Ticket::TYPE_HELP => 'mail.mail-contact',
        Ticket::TYPE_REPORT_RESOURCE => 'mail.resource-report',
    ];

    /**
     * @var User
     */
    public $user;

    /**
     * @var Ticket
     */
    public $ticket;

    /**
     * ReportBug constructor.
     * @param User   $user
     * @param Ticket $ticket
     */
    public function __construct(User $user, Ticket $ticket)
    {
        $this->user = $user;
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view(self::TYPE_VIEW_MAPPING[$this->ticket->ticket_type]);
    }
}
