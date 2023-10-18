<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\View\View;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function userDashboard(){
        return view('dashboard');
    }

      // Display the profile update form
      public function edit()
      {
          $user = Auth::user();
          return view('profile.edit', compact('user'));
      }

      public function update(Request $req){
        $userId = $req->id;
        
        //if theres any image
        if($req->file('profileImage')){
            // dd('Yes image');
            $user = User::findOrFail($userId);

            if($user->profileImage != null || $user->profileImage != ""){
                $file_path = public_path($user->profileImage); // Get the absolute file path
                          
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            $image = $req->file('profileImage');
            $name_gen = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();


             // Specify the desired directory path
             $directory = 'upload/user-profile/';

             $save_url = 'upload/user-profile/'.$name_gen;
 
              // Create the directory if it doesn't exist
              if (!Storage::exists($directory)) {
                  Storage::makeDirectory($directory);
              }

            //resize 
            Image::make($image)->resize(430,327)->save(public_path($directory . $name_gen));

            $save_url = 'upload/user-profile/'.$name_gen;

            User::findOrFail($userId)->update([
                'name' => $req->name,
                'email' => $req->email,
                'username' =>$req->username,
                'phoneNumber' => $req->phoneNumber,
                'profileImage' => $save_url
            ]); 
            
        }else{
            // dd('no image');
            User::findOrFail($userId)->update([
                'name' => $req->name,
                'email' => $req->email,
                'username' =>$req->username,
                'phoneNumber' => $req->phoneNumber
            ]); 

        }

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');

        // $notification = array(
        //     'message' => 'Profile Updated Successfully',
        //     'alert-type' => 'success',
        // ); 

        // return redirect()->route('profile.edit')->with($notification);
      }
}
