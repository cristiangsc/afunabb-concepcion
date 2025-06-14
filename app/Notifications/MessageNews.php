<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageNews extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $noticia)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('AFUNABB ha publicado nueva noticia')
                    ->greeting('Afunabb Chillán a publicado una nueva noticia')
                    ->line($this->noticia->title)
                    ->action('Leer noticia', url('/noticias/'.$this->noticia->id))
                    ->line('Puedes leer todo el contenido en nuestra web www.afunabb.cl');

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function viaQueues(): array
    {
        return [
            'mail' => 'email-noticias',
        ];
    }
}
