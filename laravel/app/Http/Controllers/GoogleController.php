<?php

namespace App\Http\Controllers;
use App\Http\Controllers\MailController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
                if (isset($_COOKIE['box'])) {
                    $location = $_COOKIE['box'];
                    setcookie('box', '', time() - 3600);
                    return redirect($location);
                } else {
                    return redirect('/home/index');
                }
            } else {
                $avatar = $user->avatar;
                $user = User::firstOrCreate([
                    'google_id' => $user->id,
                    'email' => $user->email,
                    'given_name' => $user->offsetGet('given_name'),
                    'family_name' => $user->offsetGet('family_name'),
                    'profile_photo_path' => $avatar,
                    'password' => encrypt('my-google'),
                ]);
            
                Auth::login($user, true);
               // Mail::to($user->email)->send(new WelcomeUser($user));
                $mail = new MailController();
                $mail->welcome();

                if (isset($_COOKIE['invited_by'])) {

                   
                    $invitation = array(
                    'google_id' => $user->id,
                    'invited_by' => $_COOKIE['invited_by']
                );
                    
                    DB::table('invitations')
                    ->insert($invitation);

                }
               
                if (isset($_COOKIE['box'])) {
                    $location = $_COOKIE['box'];
                    setcookie('box', '', time() - 3600);
                    return redirect($location);
                } else {
                    return redirect('/home/index');
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
