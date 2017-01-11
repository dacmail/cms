<?php

namespace App\Mail;

use App\Models\Webs\Web;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WebCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    public $web;

    /**
     * @var
     */
    public $install_code;

    /**
     * Create a new message instance.
     * @param Web $web
     * @param $install_code
     */
    public function __construct(Web $web, $install_code)
    {
        $this->web = $web;
        $this->install_code = $install_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.web.created')
            ->subject('¡Bienvenidos a ProteCMS!');
    }
}
