<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Requested extends Notification
{
    use Queueable;

    public $type;
    public $target;
    public $msg;
    public $pronom;
    public $request;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type, $target, $request, bool $response)
    {
        $this->type = $type;
        $this->target = $target;
        $this->request = $request;
        $this->response = $response;
        if ($this->type == 'action') {
            $this->pronom = ' cette ';
        }
        else{
            $this->pronom = ' ce ';
        }
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
        if ($this->response) {
            return (new MailMessage)
                    ->success()
                    ->subject("Demande d'achat de {$this->type} sur UVAR ")
                    ->line("{$notifiable->name}, votre demande d'achat de {$this->request->total} {$this->type} de {$this->target->name} a été approuvé. Vous êtes désormais détenteur de {$this->pronom} {$this->type}")
                    ->line('UVAR, la qualité du service, fait la différence');
        }
        else{
            return (new MailMessage)
                    ->error()
                    ->subject("Demande d'achat de {$this->type} sur UVAR ")
                    ->line("{$notifiable->name}, votre demande d'achat de {$this->request->total} {$this->type} de {$this->target->name} a été rejeté. Veuillez contacter le service client UVAR pour plus de détail")
                    ->line('UVAR, la qualité du service, fait la différence');
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
