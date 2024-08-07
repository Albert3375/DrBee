<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendContactForm(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Preparar los datos para el correo
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ];

        // Nombre personalizado para el remitente
        $customSenderName = 'Nombre Personalizado';

        // Enviar el correo al email proporcionado por el usuario
        Mail::send('emails.contact', ['data' => $data], function ($message) use ($data, $customSenderName) {
            $message->to($data['email'], $data['name']) // Enviar al correo proporcionado
                ->subject('Gracias por contactarnos');
            $message->from(config('mail.from.address'), $customSenderName); // Usar nombre personalizado
        });

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'Mensaje enviado exitosamente.');
    }
}
