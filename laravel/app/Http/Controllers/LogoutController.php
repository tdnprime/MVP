<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
   
    //peforms logout
    public function perform(Request $request) {
       Session::flush();
       Auth::guard('web')->logout();
       return redirect('/');
    }
}
