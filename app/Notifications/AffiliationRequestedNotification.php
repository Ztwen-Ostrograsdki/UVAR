<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AffiliationRequestedNotification extends Notification
{
    use Queueable;

    public $member;
    public $referee;
    public $success;
    public $author;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($member = null, $referee = null, $success = false, $author = '')
    {
        $this->member = $member;
        $this->referee = $referee;
        $this->success = $success;
        $this->author = $author;
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
        if ($this->member !== null && $this->referee) {
            if ($this->success) {
                return (new MailMessage)
                    ->success()
                    ->subject("Approbation d'affiliation sur UVAR ")
                    ->line("{$notifiable->name} Votre demande d'affiliation de {$this->referee->name} dont l'address mail est {$this->referee->email} a été validé par UVAR.")
                    ->line("Vous êtes à présent son affiliant, sur ce vous bénéficiez d'un bonus de 500 FCFA")
                    ->line('UVAR vous remercie et vous promet une meilleure expérience utilisateur');
            }
            else{
                return (new MailMessage)
                    ->error()
                    ->subject("Approbation d'affiliation sur UVAR ")
                    ->line("{$notifiable->name} Votre demande d'affiliation de {$this->referee->name} dont l'address mail est {$this->referee->email} a été rejeté {$this->author}!")
                    ->line("Veuillez contacter le service client UVAR pour plus de détails")
                    ->line('UVAR vous remercie et vous promet une meilleure expérience utilisateur');
            }
        }
        else{
            return (new MailMessage)
                ->subject("Approbation d'affiliation sur UVAR ")
                ->line("{$notifiable->name}, la demande de {$this->member->name}, en ce qui concerne votre affiliation a été validé par UVAR.")
                ->line("Félicitation, Vous êtes à présent MEMBRE UVAR")
                ->line("Veuillez vous connecter pour éditer votre profil et renseigner vos informations")
                ->line('UVAR vous remercie et vous promet une meilleure expérience utilisateur');
        }
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
