<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\TramiteNotification;
use Illuminate\Support\Facades\Notification;

class TramiteListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Notification::send(User::where('id', 1)->first(), new TramiteNotification($event->tramite));
        Notification::send(User::where('id', 5)->first(), new TramiteNotification($event->tramite));
    }
}
