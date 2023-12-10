<?php

namespace App\Http\Controllers;

use App\Models\EducationTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Auth;

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
        $json = json_decode($req->paymentJSON);
        //get user
        // dd($json);
        $user = Auth::user();



        EducationTransaction::insert([
            'paymentType' => $json->payment_type,
            'transaction_id' => $json->transaction_id,
            'transaction_status' => $json->transaction_status,
            'order_id' => $json->order_id,
            // 'paymentCode' => $json->payment_code,
            'paymentCode' => '',
            'jsonData' => $req->paymentJSON,
            'pdf_url' => $json->pdf_url,
            'fraud_status' => $json->fraud_status,
            'snap_token' => $req->snapToken, //ganti snap token
            'total_price' => $json->gross_amount,
            'userId' => $user->id,
            'username' => $user->name,
            'phoneNumber'=>$user->phoneNumber,
            'email' => $user->email,
            'created_at' => Carbon::now(),
        ]);


        //nanti munculin success modal
        $notification = array(
            'message' => 'Payment Success',
            'alert-type' => 'success',
        ); 
        return redirect()->back()->with($notification);
    }
}
