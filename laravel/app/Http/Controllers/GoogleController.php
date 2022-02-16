<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\WelcomeUser;
use App\Models\User;
use Cookie;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
     * handles GoogleAdminCallback sinstance.
     *
     * @return void
     */
    public function handleGoogleAdminCallback()
    {
        $user = Socialite::driver('GoogleAdmin')->stateless()->user();
        $finduser = User::where('google_id', $user->id)->first();

        if ($finduser) {
            Auth::login($finduser);
            
            if (Auth::user()->user_type == 'Adminstrator')
            {
                return redirect('/admin/dashboard');
            }
            return redirect('/home/index');
        } else {
            $avatar = $user->avatar;
            $user = User::firstOrCreate([
                'google_id' => $user->id,
                'email' => $user->email,
                'given_name' => $user->offsetGet('given_name'),
                'family_name' => $user->offsetGet('family_name'),
                'profile_photo_path' => $avatar,
                'user_type' => "Adminstrator",
                'password' => encrypt('my-google'),
            ]);


            Auth::login($user, true);
        }
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

                #Redirect to box
                if (isset($_COOKIE['box'])) {
                    $location = $_COOKIE['box'];
                    $cookie = Cookie::forget('box');
                    return redirect($location)->withCookie($cookie);
                } else {
                    #Handle app admin
                    if (Auth::user()->user_type == 'Adminstrator') {
                        return redirect('/admin/dashboard');
                    }
                    return redirect('/home/index');
                }
            } else {
                #Save new user
                $avatar = $user->avatar;
                $user = User::firstOrCreate([
                    'google_id' => $user->id,
                    'email' => $user->email,
                    'given_name' => $user->offsetGet('given_name'),
                    'family_name' => $user->offsetGet('family_name'),
                    'profile_photo_path' => $avatar,
                    'password' => encrypt('my-google'),
                ]);

                #Queue welcome email
                Auth::login($user, true);
                $details['email'] = $user->email;
                $message = new WelcomeUser($user);
                SendEmailJob::dispatch($details, $message)->onQueue('emails');
                
                #Handle invitations
                if (isset($_COOKIE['invited_by'])) {

                    $invitation = array(
                        'user_id' => $user->id,
                        'invited_by' => $_COOKIE['invited_by'],
                    );

                    DB::table('invitations')
                        ->insert($invitation);

                }

            }
        } catch (Exception $e) {
            dd($e);
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
