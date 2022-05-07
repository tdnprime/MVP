<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        //$category = $request["item"];

        
        if ($user = Auth::user()) {
            $id = auth()->user()->id;
            $user = User::find($id);
        }

            return view('cart.index', compact('user', 'user'));
        }
}
