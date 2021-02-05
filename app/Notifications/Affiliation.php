<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Affiliation extends Notification
{
    use Queueable;

    public $referer;
    public $referee;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($referer, $referee)
    {
        $this->referer = $referer;
        $this->referee = $referee;
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
                    ->subject("Demande d'affiliation sur UVAR ")
                    ->line("{$this->referer->name} vient de faire une demande d'affiliation de {$this->referee->name}")
                    ->action('Confirmé cette demande', url("UVAR/confirmation/{$notifiable->id}/affiliation"))
                    ->line('UVAR vous remercie et vous promet une meilleure expérience utilisateur');
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
