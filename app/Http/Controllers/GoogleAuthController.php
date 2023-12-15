<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callbackGoogle(){
        try {
            //get google user detail
            $socialUser = Socialite::driver('google')->user();

            //check if google user already exist in db or not

            $user = User::where('google_id', $socialUser->getId())->first();

            //if user doesnt exist in db
            if(!$user){
                $newUser = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'google_id' => $socialUser->getId()
                ]);

                Auth::login($newUser);

                return redirect()->intended('dashboard');
            }else{
                Auth::login($user);
                return redirect()->intended('dashboard');
            }

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function callback($provider){
        $socialUser = Socialite::driver($provider)->user();

        $checkUser = User::where('email', $socialUser->email)->first();

        
        if($checkUser){
            Auth::login($checkUser);
        }else{
             $user = User::updateOrCreate([
                'provider_id' => $socialUser->id,
                'provider' => $provider
            ], [
                'name' => $socialUser->name,
                'username' => $socialUser->getNickname(),
                'email' => $socialUser->email,
                'provider_token' => $socialUser->token,
            ]);
        
            Auth::login($user);
        }
        
        return redirect('/dashboard');
    }

    
}
