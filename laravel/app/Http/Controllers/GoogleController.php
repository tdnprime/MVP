<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect('/home/index');
            } else {
                $user = User::firstOrCreate([
                    'google_id' => $user->id,
                    'email' => $user->email,
                    'given_name' => $user->offsetGet('given_name'),
                    'family_name' => $user->offsetGet('family_name'),
                    'password' => encrypt('my-google'),
                ]);

                Auth::login($user, true);
                //$mail = new MailController();
                // $mail->welcome();
                /*Mail::to($request->user())
                    ->queue(new WelcomeUser);*/
                return redirect('/home/index');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function status()
    {
        $status = Auth::check();
        if ($status) {
            echo 1;
        } else if (!$status) {
            echo 0;
        }
    }
}
