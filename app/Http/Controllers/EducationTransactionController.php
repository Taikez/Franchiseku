<?php

namespace App\Http\Controllers;

use App\Models\EducationTransaction;
use App\Models\EducationContent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;


class EducationTransactionController extends Controller
{
    public function index(Request $req)
    {
        //get user
        $user = Auth::user();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED', true);
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS', true);

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

        return view('testMidtrans', compact('snapToken'));
        // return $snapToken;
    }

    public function CreateTransaction(Request $req){

        // dd($req);
        //GET USER
        $user = Auth::user();
        $education = EducationContent::findOrFail($req->educationId);
        
        //GET SNAP TOKEN
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = false;

            $params = [
                'transaction_details' => [
                    'order_id' => rand(),
                    'gross_amount' => $education->educationPrice,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'last_name' => '',
                    'email' => $user->email,
                    'phone' => $user->phoneNumber,
                ],
                'item_details' => [
                    [
                        'id' => 'a1',
                        'price' => $education->educationPrice,
                        'quantity' => 1,
                        'name' => $education->educationTitle,
                    ],
                ],
            ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        EducationTransaction::insert([
            'education_id'=>$req->educationId,
            'userId' => $user->id,
            'transaction_status' => 'pending',
            'username' => $user->name,
            'snap_token' => $snapToken,
            'phoneNumber' => $user->phoneNumber,
            'email' => $user->email,
            'created_at' => Carbon::now(),
        ]);

        //get transaction id
        $transactionId = $educationTransactionId = DB::getPdo()->lastInsertId();

        $educationTransaction = EducationTransaction::findOrFail($transactionId);
        
        
        return view('educationCheckout', compact('education','snapToken','educationTransaction'));
    }

    public function GetEducationTransaction($id){
        $educationTransaction = EducationTransaction::findOrFail($id);
        $education = EducationContent::findOrFail($educationTransaction->education_id);
        $snapToken = $educationTransaction->snap_token;


         //GET USER
        $user = Auth::user();
        // GET EDUCATION CONTENT

        return view('educationCheckout', compact('education','snapToken','educationTransaction'));
    }

    public function PostTransaction(Request $req)
    {

        //GET USER
        $user = Auth::user();
        $education = EducationContent::findOrFail($req->educationId);

        //GET SNAP TOKEN
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = false;

            $params = [
                'transaction_details' => [
                    'order_id' => rand(),
                    'gross_amount' => $education->educationPrice,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'last_name' => '',
                    'email' => $user->email,
                    'phone' => $user->phoneNumber,
                ],
                'item_details' => [
                    [
                        'id' => 'a1',
                        'price' => $education->educationPrice,
                        'quantity' => 1,
                        'name' => $education->educationTitle,
                    ],
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);
    }

    public function TransactionCallback(Request $req){
        $json = json_decode($req->paymentJSON);
        // dd($req);
        //get user
        $user = Auth::user();
        $pdfUrl = isset($json->pdf_url) ? $json->pdf_url : null;
        
        //get education
        // $education = Education::findOrFail($json->education_id);

        $paymentCode = isset($json->payment_code) ? $json->payment_code : null;

        $transaction = EducationTransaction::findOrFail($req->transactionId);

        $transaction->update([
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
            'phoneNumber' => $user->phoneNumber,
            'email' => $user->email,
            'created_at' => Carbon::now(),
        ]);
      
        //nanti munculin success modal
        $message = '';

        if ($json->transaction_status == 'settlement') {
            $message = 'Payment success! Enjoy your education content!';
            return redirect()->route('education.detail', ['id' => $req->educationId])->with('success', $message);
        } else if ($json->transaction_status == 'pending') {
            $message = 'Payment pending! Please finish your payment!';
            return redirect()->route('education.detail', ['id' => $req->educationId])->with('warning', $message);
        } else if ($json->transaction_status == 'expire') {
            $message = 'Payment expired! Please retry your payment!';
            return redirect()->route('education.detail', ['id' => $req->educationId])->with('error', $message);
        } else if ($json->transaction_status == 'failure') {
            $message = 'Payment failed! Please retry your payment!';
            return redirect()->route('education.detail', ['id' => $req->educationId])->with('error', $message);
        }
        
    }
}
