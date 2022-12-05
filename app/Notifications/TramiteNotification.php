<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\Nconforme;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NconformeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Nconforme $nConforme)
    {
        dd($request->all());
        $this->nConforme = $nConforme;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'noConformeID'  => $this->nConforme->id,
            'reportado'     => $this->nConforme->reportado,
            'proceso'       => $this->nConforme->proceso,
            'nCproceso'     => $this->nConforme->nCproceso,
            'nCdescripcion' => $this->nConforme->nCdescripcion,
            'nCacciones'    => $this->nConforme->nCacciones,
            'accion'        => $this->nConforme->accion,
            'time'          => Carbon::now()->diffForHumans(),
        ];
    }
}
