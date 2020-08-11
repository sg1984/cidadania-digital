<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use \Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewRegister extends Mailable
{
    use Queueable, SerializesModels;

    private const NEW_REGISTER_BLADE = 'mail.new-register';

    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $password;

    /**
     * NewRegister constructor.
     * @param User   $user
     * @param string $password
     */
    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @return NewRegister
     */
    public function build()
    {
        return $this->view(self::NEW_REGISTER_BLADE);
    }
}
