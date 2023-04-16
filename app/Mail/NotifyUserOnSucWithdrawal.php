<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyUserOnSucWithdrawal extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $id;
    public $amount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $id, $amount)
    {
        $this->user = $user;
        $this->id = $id;
        $this->amount = $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.html.notifyUserSucWithdrawal')
                    ->subject('Withdrawal of $'.$this->amount.' approved Successfully!');
    }
}
