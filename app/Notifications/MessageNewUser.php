<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageNewUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $user)
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
            ->subject('AFUNABB te da la Bienvenida')
            ->greeting('Estimado/a socio/a junto a un cordial saludo te damos la bienvenida a la Asociación de Funcionarios no Académicos Chillán, a continuación encontrarás las credenciales para que haga uso de la plataforma web.')
            ->line('Debes ingresar con tu correo electrónico institucional: '.$this->user->email)
            ->line('La contraseña es tu rut sin puntos ni guión: '.$this->user->rut.' te sugerimos cambiarla a la brevedad posible')
            ->action('www.afunabb.cl', url('/'))
            ->line('Si tienes dudas, sugerencias y/o consultas, estamos disponibles para ayudarte en todo momento.');
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
}
