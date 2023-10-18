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
    
            // Extraer el correo electrónico del campo 'email' del formulario
            $recipientEmail = $request->input('email');
    
            // Enviar el correo electrónico al destinatario obtenido del formulario
            Mail::to($recipientEmail)->send(new ContactFormMail($request));
    
            // Devuelve una respuesta JSON de éxito
            return response()->json(['success' => true]);
        }
    }
    

       
  