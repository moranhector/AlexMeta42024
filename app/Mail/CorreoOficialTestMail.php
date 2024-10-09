<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoOficialTestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        // Asignamos los detalles recibidos al correo
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Definir el asunto y la vista para el contenido del correo
        return $this->subject('Correo de prueba desde el servidor oficial')
                    ->view('emails.correo_oficial_test');
    }
}
