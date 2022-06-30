<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        
        if ($user = Auth::user()) {
            $id = auth()->user()->id;
            $user = User::find($id);
        }

        if(isset($_COOKIE["cart"])){

            $cart = json_decode($_COOKIE["cart"]);
            return view('cart.index', compact('user', 'user'))
            ->with("cart", $cart);

        }else{

            return view('cart.index', compact('user', 'user'));
        }
        }
}
