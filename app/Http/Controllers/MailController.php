<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactFormEmail;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        Mail::to('juliannardita@gmail.com')->send(new ContactFormEmail($name, $email, $message));
    }
}
