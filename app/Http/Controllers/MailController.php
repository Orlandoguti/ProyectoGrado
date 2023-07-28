<?php

namespace App\Http\Controllers;

use App\Mail\ContactanosMailable; // Asegúrate de importar la clase ContactanosMailable
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function enviarCorreo(Request $request)
    {
        // Código para enviar el correo
        $correo = new ContactanosMailable;
        Mail::to('godslayer754@gmail.com')->send($correo);
        return "Mensaje Enviado";

        // Resto del código
    }
}

