<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportBug extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $type, string $content)
    {
        $this->user = $user;
        $this->type = $type;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.mail-contact');
    }
}
