<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyUserOnLoginMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $time;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $time)
    {
        $this->user = $user;
        $this->time = $time;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.html.notifyUserLogin')
                    ->subject('New Login Alert');
    }
}
