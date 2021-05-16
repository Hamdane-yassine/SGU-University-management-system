<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyImportSuccess extends Notification implements ShouldBroadcastNow
{
    use Queueable;


    public string $NomFiliere;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($NomFiliere)
    {
        $this->NomFiliere = $NomFiliere;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
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
            'image' =>'/vendors/images/success.svg',
            'from'=>'Importation avec succés',
            'idNotif'=>$this->id,
            // 'idEvent'=>json_decode($this->event)->idEvenement,
            'brief'=>"Les etudiants de la filière ".$this->NomFiliere." sont importés avec succés",
        ];
    }
}
