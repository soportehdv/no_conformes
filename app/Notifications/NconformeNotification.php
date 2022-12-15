<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\User;
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
        $usuarios = User::where('id', $this->nConforme->proceso)->first();
        $usuarios->proceso;

        return (new MailMessage)
                    ->greeting('Hola!')
                    ->subject('Notificación de nuevo no conforme')
                    ->line('Ha recibido un no conforme de: '. $usuarios->proceso)
                    ->action('Ver No Conformidad', asset('NConformes/vista/' . $this->nConforme->id))
                    ->line('Recuerda que tiene un plazo maximo de 5 dias para contestar la no conformidad')
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
