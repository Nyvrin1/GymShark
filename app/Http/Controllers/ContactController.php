<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $messageContent = $request->input('message');

        // Send the email
        Mail::to('gymsharksupp@outlook.com')->send(new ContactFormMail($name, $email, $messageContent));

        return redirect()->back()->with('status', 'Your message has been sent successfully!');
    }
}
