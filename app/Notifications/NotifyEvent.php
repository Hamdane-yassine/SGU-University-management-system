<?php

namespace App\Notifications;

use App\Models\Evenement;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;

class NotifyEvent extends Notification implements ShouldBroadcast
{
    use Queueable;

    public Evenement $event;
    public User $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    // public function __construct(User $user, Evenement $evenement)
    // {
    //     $this->user = $user;
    //     $this->event = $evenement;

    // }
    public function __construct()
    {

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
        return [
            'image' =>'Hello WORLLLD',
            // 'user'=>$this->user->email,
            // 'event from '=>$this->event->chefdep,
        ];
    }


    // public function broadcastWith()
    // {
    //     return [
    //         'msg'=> 'Hello'
    //     ];
    // }
    // public function broadcastAs()
    // {
    //     return 'Evt';
    // }


    // public function broadcastOn()
    // {
    //     return new Channel('hello');
    // }

    // public function broadcastType()
    // {
    // return 'broadcast.message';
    // }
}
