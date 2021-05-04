<?php

namespace App\Notifications;

use App\Models\Chefdep;
use App\Models\Evenement;
use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class NotifyEvent extends Notification implements ShouldBroadcast
{
    use Queueable;

    public string $user;
    public string $event;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $event)
    {
        $this->user = $user;
        $this->event = $event;
        // $this->delay(5);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['database'];
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
    // public function toBroadcast($notifiable)
    // {
    //     return [
    //         'image'=>'Hello World',
    //         'type'=>'ZOOOOO',
    //         'info'=>'',
    //     ];
    // }
    public function toArray($notifiable)
    {
        $evt = new Evenement((array)json_decode($this->event));
        // echo "evt in Noti".$evt;
        // echo $chef = Chefdep::find($this->event[0]);
        return [
            // 'image' => $evt->chefdep->professeur->user->profile->imagePath,
            'image' =>asset('/vendors/images/user.svg'),
            'from'=>$evt->chefdep->professeur->user->personne->nom.' '.$evt->chefdep->professeur->user->personne->prenom,
            'lien'=>'/events/'.Evenement::count(),
            'brief'=>Str::substr($evt->message, 0, 30).'...',
        ];
    }

    // public function broadcastWith()
    // {
    //     return [
    //         'msg'=> 'Hello'
    //     ];
    // }
    public function broadcastAs()
    {
        return 'Evt';
    }


    // public function broadcastOn()
    // {
    //     return new Channel('App.Models.User.{$id}');
    // }

    // public function broadcastType()
    // {
    // return 'broadcast.message';
    // }
}
