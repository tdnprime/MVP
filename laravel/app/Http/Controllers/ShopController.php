<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($user = Auth::user()) {
            $id = auth()->user()->id;
            $user = User::find($id);
        }
   

        return view('shop.index', compact('user', 'user'));
    }
    public function item(Request $request)
    {
        $id = $request["id"];

        if ($user = Auth::user()) {
            $u = auth()->user()->id;
            $user = User::find($u);
        }

        $id = $_GET["id"];
        $product = DB::table("products")
            ->where("id", "=", $id)
            ->get();

            $reviews = DB::table("reviews")
            ->where("product", "=", $id)
            ->get();
    
        return view('shop.item', compact('user', 'user'))
            ->with("product", $product)
            ->with("reviews", $reviews);
    }
}
