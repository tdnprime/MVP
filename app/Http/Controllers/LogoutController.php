<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //peforms logout
    public function perform()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        /*
         * Remove the socialite session variable if exists
         */

        Session::forget(config('access.socialite_session_name'));

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }
}
