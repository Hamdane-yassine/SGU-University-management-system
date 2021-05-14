<?php

namespace App\Notifications;

use App\Models\Absence;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyRattAnnule extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    public string $user;
    public string $absence;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $absence)
    {
        $this->user = $user;
        $this->absence = $absence;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['databse','broadcast'];
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
        $abs = new Absence((array)json_decode($this->absence));
        return [
            'image' =>$abs->chefdep->professeur->user->profile->croppedImage,
            'from'=>$abs->chefdep->professeur->user->personne->nom.' '.$abs->chefdep->professeur->user->personne->prenom,
            'idNotif'=>$this->id,
            // 'idEvent'=>json_decode($this->event)->idEvenement,
            'brief'=>'Votre demande de rattrapage a été rejetée.',
        ];
    }
}
