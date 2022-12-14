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
        return ['database','mail'];
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
                    ->subject('Notificación de nuevo no conforme')
                    ->greeting('Hola!')
                    ->line('Hospital Departamental de villavicencio')
                    ->line('Ha recibido un no conforme.')
                    ->action('Ver No Conformidad', url('/'))
                    ->line('Gracias por usar nuestras aplicaciones!');
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
