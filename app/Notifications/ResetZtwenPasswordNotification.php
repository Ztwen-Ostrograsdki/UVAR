<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetZtwenPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
                    ->subject('Réinitialisation de mot de passe sur UVAR')
                    ->line("Monsieur/Madame, $notifiable->name vous avez lancer un processus de Réinitialisation de votre mot de passe!")
                    ->line("Uvar, vous envoi ce mail afin d'être sur que cette action vient de vous, si vous reconnaissez cette action veuillez donc cliquer sur ce lien pour finaliser la réinitialisation de votre mot de passe!")
                    ->action('Réinitialiser maintenant', url('/password/reset/'. urlencode($this->token) . '?email=' . urlencode($notifiable->email)))
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
