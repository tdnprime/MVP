<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{

    public function submit(Request $request)
    {
        $productID = $request["product"];
        $name = $request["name"];
        $stars = $request["stars"];
        $review = $request["review"];
        DB::table("reviews")->insert(["name"=>$name,"stars"=>$stars, "review"=>$review, "product"=>$productID]);
        Session::flash('message', 'Review received');
        return Redirect::to(url()->previous());
    }
}
