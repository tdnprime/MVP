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
        return redirect('/');
    }
}
