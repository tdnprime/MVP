<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();

        return view('index', compact('user'));
    }

    public function dashboard(){
        $user = Auth::user();

        return view('home.index', compact('user'));
    }

    public function partner(){
        $user = Auth::user();

        return view('partner.index', compact('user'));
    }
}
