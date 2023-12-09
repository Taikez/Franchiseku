<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EducationTransactionController extends Controller
{
    public function index(Request $req)
    {

        //get user
        $user = Auth::user();


        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-bUxavK_9SP0WSQ2Vk3Tzq3GS';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => 5000,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'last_name' => '',
                'email' => $user->email,
                'phone' => $user->phoneNumber,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('testMidtrans',compact('snapToken'));
        // return $snapToken;
    } 

    public function PostTransaction(Request $req){
        return $req;
    }
}
