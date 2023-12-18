<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    public function Index(){
        return view('pusher.pusher');
    }

    public function BroadcastPusher(Request $req){
        broadcast(new PusherBroadcast($req->get('message')))->toOthers();

        return view('pusher/broadcast',['message' => $req->get('message')]);
    }

    public function ReceivePusher(Request $req){
        return view('pusher/receive',['message' => $req->get('message')]);
    }
}
