<?php

namespace App\Http\Controllers;
use Cookie;
use App\Http\Controllers\SquareController;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CheckoutController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){

        $id = auth()->user()->id;
        $user = User::find($id);
       $cookie = self::setCookie($request); 
  
        return view('checkout.index', compact('user'));
    }
    public function referal(){

        $id = auth()->user()->id;
        $user = User::find($id);
        return view('checkout.referal', compact('user'));
    }

    public function setCookie(Request $request)
    {
        $minutes = 10;
        $response = new Response('Set Cookie');
        $response->withCookie(cookie('checkout', '/checkout/index', $minutes));
        return $response;
    }
}
