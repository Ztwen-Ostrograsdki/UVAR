<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisterUser extends Notification
{
    use Queueable;

    public $msg;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($msg = null)
    {
        $this->msg = $msg;
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
        if ($this->msg !== null && $this->msg == 'success') {
            return (new MailMessage)
                    ->success()
                    ->subject('Confirmation de compte UVAR')
                    ->line("{$notifiable->name} Votre compte a bien été confirmé")
                    ->line('UVAR vous remercie et vous promet une meilleure expérience utilisateur');
        }
        elseif ($this->msg !== null && $this->msg == 'errors') {
            return (new MailMessage)
                    ->error()
                    ->subject('Confirmation de compte UVAR')
                    ->line("{$notifiable->name} Votre compte n'a pas été confirmé, veuillez relancer la procedure de confirmation")
                    ->line('UVAR vous remercie et vous promet une meilleure expérience utilisateur');
        }
        return (new MailMessage)
                ->success()
                ->subject('Inscription sur UVAR')
                ->line("{$notifiable->name} Votre compte a bien été créé, merci de confirmer votre adresse mail en cliquant sur le lien")
                ->action('Confirmé mon compte UVAR', url("UVAR/confirmation/id={$notifiable->id}/token=" . urlencode($notifiable->confirmation_token)))
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
