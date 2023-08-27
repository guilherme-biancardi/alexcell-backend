<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserActivationLink extends Notification
{
    use Queueable;

    public $url;
    public User $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($url, User $user)
    {
        $this->url = $url;
        $this->user = $user;
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
    public function toMail(object $notifiable): Mailable
    {
        return (new Mailable)->to(env('MAIL_USERNAME'))
            ->subject('Nova acesso solicitado!')
            ->view('userVerification', [
                'url' => $this->url,
                'user' => $this->user
            ]);
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
