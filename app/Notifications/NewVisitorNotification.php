<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewVisitorNotification extends Notification
{
    use Queueable;

    public $totalVisitor;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($totalVisitor)
    {
        $this->totalVisitor = $totalVisitor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                ->subject("Un nouveau visiteur sur le site UVAR")
                ->line("UVAR vient d'être visité par un nouvel utilisateur")
                ->action("UVAR compte aujourd'hui {$this->totalVisitor} visiteurs!", url('/'))
                ->line('UVAR, le meilleur au rendez-vous!');
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
