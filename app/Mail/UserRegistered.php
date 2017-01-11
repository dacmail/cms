<?php

namespace App\Mail;

use App\Models\Users\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistered extends Mailable
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
     * @var \App\Models\Webs\Web;
     */
    public $web;

    /**
     * Request
     */
    public $request;

    /**
     * Create a new message instance.
     * @param User $user
     * @param $request
     */
    public function __construct(User $user, $request)
    {
        $this->web = app('App\Models\Webs\Web');
        $this->user = $user;
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.auth.register');
    }
}
