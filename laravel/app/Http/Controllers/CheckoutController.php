<?php

namespace App\Http\Controllers;
use App\Http\Controllers\SquareController;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CheckoutController extends Controller
{
    public function index(){

        $id = auth()->user()->id;
        $user = User::find($id);
        return view('checkout.index', compact('user'));
    }
    public function referal(){

        $id = auth()->user()->id;
        $user = User::find($id);
        return view('checkout.referal', compact('user'));
    }
}
