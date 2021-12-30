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

    public function terms(){
        $user = Auth::user();

        return view('terms.index', compact('user'));
    }

    public function privacy(){
        $user = Auth::user();

        return view('privacy.index', compact('user'));
    }

    public function contact(){
        $user = Auth::user();

        return view('contact.index', compact('user'));
    }

    public function about(){
        $user = Auth::user();

        return view('about.index', compact('user'));
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
