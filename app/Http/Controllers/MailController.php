<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactFormEmail;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        
        $data = request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:3',
            'message' => 'required|min:3',
        ]);

        Mail::to('juliannardita@gmail.com')->send(new ContactFormEmail($data));
    }
}
