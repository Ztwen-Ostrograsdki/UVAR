<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessagerNotification extends Notification
{
    use Queueable;

    public $message;
    public $subjectTitle;
    public $affiliation;
    public $admin;
    public $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $subjectTitle, $admin = false, $affiliation = null, $data = [])
    {
        $this->message = $message;
        $this->subjectTitle = $subjectTitle;
        $this->affiliation = $affiliation;
        $this->admin = $admin;
        $this->data = $data;
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
                    ->success()
                    ->subject($this->subjectTitle)
                    ->line($this->message)
                    ->action('Je ne reconnais pas cette confirmation', url("Uvar/Je&ne&reconnais&pas&cette&demande/affiliations/manage/referer={$this->affiliation->referer_id}/referee={$notifiable->id}/token='" . urlencode($this->affiliation->token . "")))
                    ->line('UVAR vous remercie et vous promet une meilleure expérience utilisateur');
        }
        elseif($this->affiliation && $this->admin){
            return (new MailMessage)
                    ->success()
                    ->subject($this->subjectTitle)
                    ->line($this->message)
                    ->action('Confirmé cette demande', url("Uvar/administration/affiliations/manage/referer={$this->affiliation->referer_id}/referee={$this->affiliation->referee_id}/r=" . true))
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
