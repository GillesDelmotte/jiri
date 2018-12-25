<?php

namespace jiri\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use jiri\Jiri;
use jiri\User;

class JiriStarted extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $jiri;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Jiri $jiri)
    {
        $this->user = $user;
        $this->jiri = $jiri;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.jiriStarted', ['user' => $this->user, 'jiri' => $this->jiri]);
    }
}
