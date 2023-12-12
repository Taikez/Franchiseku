<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationTransaction;

class ApiController extends Controller
{
    public function TransactionHandler(Request $req){
        $json = json_decode($req->getContent());

        $signature_key = hash('sha512',$json->order_id . $json->status_code . $json->gross_amount. env('MIDTRANS_SERVER_KEY'));

        //verifikasi security transaksi midtrans
        if($signature_key != $json->signature_key){
            return abort(404);
        }else{
            $educationTransaction = EducationTransaction::where('order_id', $json->order_id)->first();
            return $educationTransaction->update(['transaction_status' => $json->transaction_status]);
        }
    }
}
