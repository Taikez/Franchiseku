<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required|min:3',
        ]);
        
        if($this->isConnectedWithInternet())
        {
            $data = [
                'recipient' => 'adm.franchiseku@gmail.com',
                'fromName' => $request->name,
                'fromEmail' => $request->email,
                'message' => $request->message
            ];

            // send message to admin
            Mail::send('emails.send-message-to-admin', ['data' => $data], function($message) use ($data) {
                $message->to($data['recipient'])
                    ->from($data['fromEmail'], $data['fromName'])
                    ->subject('User Requests / Questions');
            });

            // send message to user
            Mail::send('emails.send-reply-to-user', ['data' => $data], function($message) use ($data) {
                $message->to($data['fromEmail'])
                    ->from('adm.franchiseku@gmail.com', 'FranchiseKu Admin')
                    ->subject('We have received your email!');
            });
            
            return redirect()->route('dashboard')->with('success', 'Email sent successfully!');
        }

        else
        {
            return redirect()->route('dashboard')->with('error', 'You are not connected to the internet!');
        }
    }

    public function isConnectedWithInternet($site = "https://www.google.com")
    {
        if(@fopen($site, "r"))
        {
            return true;
        }

        else
        {
            return false;
        }
    }
}
