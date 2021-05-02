<?php

namespace App\Notifications;

use App\Models\Evenemnt;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;

class NotifyEvent extends Notification implements ShouldBroadcast
{
    use Queueable;

    public $event;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Evenemnt $Event)
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
            'image'=>$notifiable->name,
            'link'=>'',
            'info'=>'',
        ];
    }

    public function broadcastWith()
    {
        return [
            'msg'=> 'Hello'
        ];
    }

    public function broadcastAs()
    {
        return 'Evt';
    }

    public function broadcastOn()
    {
        return new PrivateChannel('hello');
    }
}
