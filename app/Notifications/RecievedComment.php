<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RecievedComment extends Notification
{
    use Queueable;

    private $comment_notification;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment_notification)
    {
        $this->comment_notification = $comment_notification;
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

    public function toDatabase($notifiable)
    {
        return $this->toArray($notifiable);
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
            'first_name' => $this->comment_notification->user->first_name,
            'surname' => $this->comment_notification->user->surname,
            'user_link' => route('users.show', ['user' => $this->comment_notification->user_id]),
            'content' => $this->comment_notification->content,
            'post_link' => route('posts.show', ['post' => $this->comment_notification->post_id]),
        ];
    }
}