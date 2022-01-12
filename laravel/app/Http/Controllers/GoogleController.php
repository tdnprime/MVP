<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
                return redirect('/home/index');
            }else{
                $user = User::firstOrCreate([
                    'google_id' => $user->id,
                    'email' => $user->email,
                    'given_name' => $user->offsetGet('given_name'),
                    'family_name' => $user->offsetGet('family_name'),
                    'password' => encrypt('my-google'),
                ]);

                Auth::login($user, true);
                $mail = new MailController();
                $mail->welcome();
                //shell_exec( dirname(__DIR__, 2) . "/Mail/WelcomeUser.php/".$user->id."' 'alert' >> " . dirname(__DIR__, 3) . "/storage/logs/laravel.log &");
                return redirect('/home/index');
            }
        }catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function status(){
        $status = Auth::check();
        if ($status) {
            echo 1;
        }else if(!$status){
            echo 0;
        }
    }
}
