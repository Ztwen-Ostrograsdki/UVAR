<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DemandeAffiliationNotification extends Notification
{
    use Queueable;

    public $demander;
    public $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($demander, $message)
    {
        $this->demander = $demander;
        $this->message = $message;
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
                    ->subject("Demande d'affiliation par un utilisateur UVAR")
                    ->line("Salut Monsieur/Madame, {$notifiable->name}, je crois savoir que vous êtes l'adminitrateur du site.")
                    ->line($this->message)
                    ->line("Mon addresse mail est {$this->demander->email}")
                    ->line('Merci de pendre en compte ma requête!');
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
