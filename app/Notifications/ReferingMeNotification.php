<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReferingMeNotification extends Notification
{
    use Queueable;

    public $affiliation;
    public $referer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($referer, $affiliation = null)
    {
        $this->affiliation = $affiliation;
        $this->referer = $referer;
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
       if ($this->affiliation) {
           return (new MailMessage)
               ->subject("Demande d'affiliation sur UVAR ")
                ->line("{$this->referer->name} vient de vous affilier.")
                ->line("Reconnaissez-vous cette demande d'affiliation? sinon cliquer sur le lien pour rejeter la demande")
                ->action('Refuser cette demande', url("Uvar/Je&ne&reconnais&pas&cette&demande/affiliations/manage/referer={$this->affiliation->referer_id}/referee={$notifiable->id}/token=" . urlencode($this->affiliation->token) . "/r=no/key=" . urlencode($this->affiliation->token) . "/e=yes"))
                ->line('UVAR vous remercie et vous promet une meilleure expérience utilisateur');
       }
       else{
            return (new MailMessage)
               ->subject("Demande d'affiliation sur UVAR ")
                ->line("Vous avez reçu une demande d'affiliation.")
                ->action("Reconnaissez-vous cette demande d'affiliation? sinon cliquer sur le lien pour rejeter la demande", url('/'))
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
