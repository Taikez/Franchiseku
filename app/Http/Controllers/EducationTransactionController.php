<?php

namespace App\Http\Controllers;

use App\Models\EducationTransaction;
use App\Models\Education;
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
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
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
        $user = Auth::user();
        $pdfUrl = isset($json->pdf_url) ? $json->pdf_url : null;
        
        //get education
        // $education = Education::findOrFail($json->education_id);

        $paymentCode = isset($json->payment_code) ? $json->payment_code : null;
        EducationTransaction::insert([
            'paymentType' => $json->payment_type,
            'transaction_id' => $json->transaction_id,
            'transaction_status' => $json->transaction_status,
            'order_id' => $json->order_id,
            'paymentCode' => $paymentCode,
            'jsonData' => $req->paymentJSON,
            'pdf_url' => $pdfUrl,
            'fraud_status' => $json->fraud_status,
            'education_id'=>$req->educationId,
            'snap_token' => $req->snapToken, //ganti snap token
            'total_price' => $json->gross_amount,
            'userId' => $user->id,
            'username' => $user->name,
            'phoneNumber'=>$user->phoneNumber,
            'email' => $user->email,
            'created_at' => Carbon::now(),
        ]);
      
        //nanti munculin success modal
        $message = '';
        if($json->transaction_status == 'settlement') {
            $message = 'Payment success! Enjoy your education content!';
            return redirect()->back()->with('success', $message);

        } else if($json->transaction_status == 'pending') {
            $message = 'Payment pending! Please finish your payment!';
            return redirect()->back()->with('warning', $message);

        } else if($json->transaction_status == 'expire') {
            $message = 'Payment expired! Please retry your payment!';
            return redirect()->back()->with('error', $message);
            
        } else if($json->transaction_status == 'failure') {
            $message = 'Payment failed! Please retry your payment!';
            return redirect()->back()->with('error', $message);
            
        }

    }
}
