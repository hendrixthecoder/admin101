<?php

namespace App\Listeners;

use App\Events\NewROISent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendROIRecievedEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewROISent  $event
     * @return void
     */
    public function handle(NewROISent $event)
    {
        dd('roi sent');
    }
}
