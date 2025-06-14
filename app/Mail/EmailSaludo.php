<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailSaludo extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct(public $contenido)
    {
        //
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'AFUNABB CHILLÁN TE SALUDA EN TU CUMPLEAÑOS',
        );
    }


    public function build(): EmailSaludo
    {
        return $this->markdown('emails.saludo')
            ->from('administrador@cscdeveloper.com')
            ->with('contenido', $this->contenido);
    }

}
