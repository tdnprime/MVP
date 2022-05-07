<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = $request["category"];

        if ($user = Auth::user()) {
            $id = auth()->user()->id;
            $user = User::find($id);
        }

        return view('shop.index', compact('user', 'user'));
    }
    public function item(Request $request)
    {
        $category = $request["item"];

        if ($user = Auth::user()) {
            $id = auth()->user()->id;
            $user = User::find($id);
        }

        return view('shop.item', compact('user', 'user'));
    }
}
