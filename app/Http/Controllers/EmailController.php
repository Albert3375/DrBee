<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'recipient' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $details = [
            'recipient' => $request->recipient,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        Mail::send([], [], function($message) use ($details) {
            $message->to($details['recipient'])
                    ->subject($details['subject'])
                    ->setBody($details['message'], 'text/html');
        });

        return response()->json(['message' => 'Email sent successfully!'], 200);
    }
}
