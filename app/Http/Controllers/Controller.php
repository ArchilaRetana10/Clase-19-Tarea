<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;

class ContactController extends Controller
{
    public function sendContactForm(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->to('contact@example.com') // Cambia este correo por el destinatario real
                    ->subject(Lang::get('messages.contact_success'));
        });
        
        return redirect()->back()->with('success', Lang::get('messages.contact_success'));
    }
}