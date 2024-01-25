<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Franchisor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class FranchisorController extends Controller
{
    public function StoreFranchisor(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phoneNumber' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);


        // note
        // requirement untuk register franchisor apa aja ? user bisa pake klik tombol ajaga gausa bkin form.. jd nnti sesuain sama data user  
        // 

        // Create a new user
        $user = new User;
        $user->name = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->phoneNumber = $validatedData['phoneNumber'];
        $user->password = Hash::make($validatedData['password']); // Hash the password
        $user->role = 'Franchisor'; // Set the role to "Franchisor" for new users
        $user->save();

          // Create a new franchisor entry associated with the user
          Franchisor::insert([
            'username' => $request->username,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'password' => $request->password,
            'address' => $request->address, // add new column
            'created_at' => Carbon::now(),
        ]);

        $response = [
            'message' => 'Franchisor Registered Successfully!',
            'modal' => '#successModal', // Modal ID to trigger
            ];

        // Flash the data to the session
        session()->flash('success_data', $response);        
    
        return  redirect()->back()->with('successData', $response);
    }

    public function addFranchise(Request $request){
        // Create a new franchisor entry associated with the user
        Franchisor::insert([
            'username' => $request->username,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'password' => $request->password,
            'address' => $request->address, // add new column
            'created_at' => Carbon::now(),
        ]);

        // You can optionally log the user in here if needed

        $response = [
        'message' => 'Franchisor Registered Successfully!',
        'modal' => '#successModal', // Modal ID to trigger
        ];

        return response()->json($response);
    }

    public function AllFranchisor(){
        $allFranchisor = User::where('role','Franchisor')->get();
        return view('admin.franchisor.all_franchisor',compact('allFranchisor'));
    }

    public function RegisterFranchisor(){
        return view('franchisor.add_franchisor');
    }
}
