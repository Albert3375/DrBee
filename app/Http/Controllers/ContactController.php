<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('web.contacto');
    }

    public function sendContactForm(Request $request)
    {
        // Validación de datos aquí (si es necesario)

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
         
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false]);
        }

        // Procesa y envía el correo electrónico aquí

        Mail::to('mendezalberto295@gmail.com')->send(new ContactFormMail($request));

        // Devuelve una respuesta JSON de éxito
        return response()->json(['success' => true]);
    }
}

       
  