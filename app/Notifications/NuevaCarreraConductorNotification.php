<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\FcmNotification;
use NotificationChannels\Apn\ApnChannel;
use NotificationChannels\Apn\ApnMessage;

class NuevaCarreraConductorNotification extends Notification
{
    use Queueable;
    private $carrera;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($carrera)
    {
        $this->carrera=$carrera;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FcmChannel::class, ApnChannel::class];
    }

    public function toFcm($notifiable)
    {
        // The FcmNotification holds the notification parameters
        $fcmNotification = FcmNotification::create()
            ->setTitle('Nueva carrera '.$this->carrera->direccion)
            ->setBody('Ingresa para ver la nueva carrera');


        // The FcmMessage contains other options for the notification
        return FcmMessage::create()
            ->setPriority(FcmMessage::PRIORITY_HIGH)
            ->setTimeToLive(86400)
            ->setNotification($fcmNotification)
            ->setData(["carrera"=>$this->carrera->id,"tipo"=>"nueva_carrera"]);
        ;
    }

    public function toApn($notifiable)
    {
        return ApnMessage::create()
            ->badge(1)
            ->title('Factura '.$this->carrera->direccion)
            ->body('Ingresa para ver la nueva carrera')
            ->custom("factura", $this->carrera->id)
            ->custom("tipo", 'nueva_carrera');
        ;
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
            //
        ];
    }
}
