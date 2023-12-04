<?php

namespace App\Notifications;

use App\Models\UsersOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class UserOrderNotification extends Notification
{
    use Queueable;
    private $usersOrder;

    /**
     * Create a new notification instance.
     */
    public function __construct(UsersOrder $usersOrder)
    {
        $this->usersOrder = $usersOrder;

    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => $this->usersOrder,
        ]);
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
