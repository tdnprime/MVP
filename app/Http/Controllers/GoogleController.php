<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeUser;

class GoogleController extends Controller
{
        /**

     * Create a new controller instance.

     *

     * @return void

     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
         /**

     * Create a new controller instance.

     *

     * @return void

     */
    public function handleGoogleCallback()
    {
        try{
            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){
                Auth::login($finduser);
                return redirect('/dashboard');
            }else{
                $user = User::firstOrCreate([
                    'google_id' => $user->id,
                    'email' => $user->email,
                    'name' => $user->name,
                    'password' => encrypt('my-google'),
                ]);

                Auth::login($user, true);

                Mail::to($user->email)->send(new WelcomeUser($user));

                return redirect('/dashboard');
            }
        }catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
