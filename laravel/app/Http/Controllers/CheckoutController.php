<?php

namespace App\Http\Controllers;

use App\Models\User;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckoutController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $id = auth()->user()->id;
        $user = User::find($id);
        //$cookie = self::setCookie($request);
        if (isset($_COOKIE["cart"])) {
            $cart = json_decode($_COOKIE["cart"]);
            return view('checkout.index', compact('user'))
            ->with("cart", $cart);
        }
    }
    public function referal()
    {

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
