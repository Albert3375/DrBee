<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnviarMensaje extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;

    public function __construct($datos)
    {
        $this->datos = $datos;
        $this->from('DDTCH@gmail.com.mx'); // Establecer el remitente aquí
    }

    public function build()
    {
        return $this->from('DDTCH@gmail.com.mx', ' DDTCH Trade Company LLC')
            ->subject('Nuevo mensaje de contacto')
            ->view('emails.enviar-mensaje');
    }
}