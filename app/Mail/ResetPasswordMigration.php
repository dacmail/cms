<?php

namespace App\Mail;

use App\Models\Users\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordMigration extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance
     *
     * @var User
     */
    public $user;

    /**
     * The web instance
     *
     * @var Web;
     */
    public $web;

    /**
     * New password
     *
     * @var string $password;
     */
    public $password;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param string $password
     */
     public function __construct(User $user, string $password)
     {
         $this->web = app('App\Models\Webs\Web');
         $this->user = $user;
         $this->password = $password;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reset_password_migration')
            ->subject('Reincio de contraseña');
    }
}
