<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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
      
        $address = DB::table("users")
        ->where("id", $id)
        ->get()[0];

        if (isset($_COOKIE["cart"])) {
            $cart = json_decode($_COOKIE["cart"]);
            return view('checkout.index', compact('user'))
                ->with("cart", $cart)
                ->with("address", $address);
        }
    }

    public function price($quantity, $cadence, $basePrice)
    {

        if ($cadence == 1) {
            $price = $basePrice;
        } else if ($cadence == 2) {
            $price = $basePrice + 1;
        } else if ($cadence == 3) {
            $price = $basePrice + 2;
        } else if ($cadence == 0) {
            $price = $basePrice + 3;
        }

        return $price * $quantity;
    }

    public function order(Request $request)
    {

        $order = json_decode(json_decode($request["order"])); 
        $id = auth()->user()->id;
        $user = User::find($id);

        foreach ($order as $item) {

           $basePrice = DB::table("products")
                ->where("id", $item->product)
                ->select("price")
                ->get()[0]->price;

            $sub["product_id"] = $item->product;
            $sub["total"] = self::price($item->quantity, $item->plan, $basePrice);
            $sub["frequency"] = $item->plan;
            $sub["user_id"] = $id;
            $sub["quantity"] = $item->quantity;
            
            DB::table("subscriptions")
            ->insert($sub);

        }
        // Call Square

        return true;

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = json_decode($request["addr"]);
        $id = auth()->user()->id;
        $user = User::find($id);
        $subscription = [];

        $subscription["given_name"] = $data->given_name;
        $subscription["family_name"] = $data->family_name;
        $subscription["address_line_1"] = $data->address_line_1;
        $subscription["address_line_2"] = $data->address_line_2 ?? null;
        $subscription["admin_area_1"] = $data->admin_area_1;
        $subscription["admin_area_2"] = $data->admin_area_2;
        $subscription["postal_code"] = $data->postal_code;
        $subscription["country_code"] = $data->country_code;

        DB::table("users")
            ->where("id", $id)
            ->update($subscription);

        return true;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeBilling(Request $request)
    {
        $data = json_decode($request["addr"]);
        $id = auth()->user()->id;
        $user = User::find($id);

        $subscription = [];
        $subscription["billing_given_name"] = $data->billing_given_name;
        $subscription["billing_family_name"] = $data->billing_family_name;
        $subscription["billing_address_line_1"] = $data->billing_address_line_1;
        $subscription["billing_address_line_2"] = $data->billing_address_line_2 ?? null;
        $subscription["billing_admin_area_1"] = $data->billing_admin_area_1;
        $subscription["billing_admin_area_2"] = $data->billing_admin_area_2;
        $subscription["billing_postal_code"] = $data->billing_postal_code;
        $subscription["billing_country_code"] = $data->billing_country_code;

        DB::table("users")
            ->where("id", $id)
            ->update($subscription);

        return true;
    }

}
