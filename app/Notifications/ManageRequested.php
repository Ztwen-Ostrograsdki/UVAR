<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ManageRequested extends Notification
{
    use Queueable;

    public $request;
    public $type;
    public $target;
    public $demander;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request, $type, $target, $demander)
    {
        $this->type = $type;
        $this->request = $request;
        $this->target = $target;
        $this->demander = $demander;
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
                    ->subject("Demande d'achat de {$this->type} sur UVAR ")
                    ->line("{$this->demander->name} vient de faire une demande d'achat de {$this->request->total} {$this->type}s de {$this->type} {$this->target->name}")
                    ->action('Confirmé cette demande', url("/"))
                    ->line('UVAR, la qualité du service, fait la différence');
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
