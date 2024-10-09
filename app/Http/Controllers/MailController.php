<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\CorreoOficialTestMail;
use Mail;

class MailController extends Controller
{
    public function sendOfficialEmail()
    {
        // Detalles del correo
        $details = [
            'title' => 'Correo de prueba usando el servidor oficial',
            'body' => 'Este es el contenido del correo enviado desde el servidor oficial de la empresa.'
        ];

        // Enviar el correo
        Mail::to('moranhector@gmail.com')->send(new CorreoOficialTestMail($details));

        return "¡Correo enviado con éxito!";
    }
}
