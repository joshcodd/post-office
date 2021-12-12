<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RecievedLike extends Notification implements ShouldBroadcast
{
    use Queueable;

    private $like_notification;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($like_notification)
    {
        $this->like_notification = $like_notification;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
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
        $first_name = $this->like_notification->user->first_name;
        $surname = $this->like_notification->user->surname;
        return (new MailMessage)
            ->line($first_name . " " . $surname . (' has liked your post!'))
            ->action('View post', route('posts.show', ['post' => $this->like_notification->likeable->id]))
            ->line('Thank you for using PostOffice!');
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage(['data' => $notifiable->notifications()->find($this->id)]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

        if ($this->like_notification->likeable_type == 'App\Models\Post') {
            $type = "post";
            $post_id = $this->like_notification->likeable->id;
        } else if ($this->like_notification->likeable_type == 'App\Models\Comment') {
            $type = "comment";
            $post_id = $this->like_notification->likeable->post->id;
        }

        return [
            'first_name' => $this->like_notification->user->first_name,
            'surname' => $this->like_notification->user->surname,
            'user_link' => route('users.show', ['user' => $this->like_notification->user]),
            'post_link' => route('posts.show', ['post' => $post_id]),
            'type' => $type,
        ];
    }
}