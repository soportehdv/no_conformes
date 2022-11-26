<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NconformeNotification;
use Illuminate\Support\Facades\Notification;

class NconformeListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Notification::send(User::where('id', $event->nConforme->nCproceso)->first(), new NconformeNotification($event->nConforme));
        Notification::send(User::where('id', 5)->first(), new NconformeNotification($event->nConforme));
    }
}
