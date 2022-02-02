<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SquareController extends Controller
{
    public function charge(Request $request)
    {

        $charge = json_decode($request['charge']);
        $amount =  (int)$charge->amount * 100;
        $config = parse_ini_file(dirname(__DIR__, 3) . "/config/app.ini", true);
        $token = $config['square']['access_token'];
        $endpoint = $config['square']['payments'];

        
        $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $token,
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($endpoint, [
            "idempotency_key" => $charge->sourceId,
            "amount_money" => [
                "amount" => $amount,
                "currency" => "USD",
            ],
            "source_id" => $charge->sourceId,
            "autocomplete" => true,
            "location_id" => $charge->locationId,
            "note" => "Shipping labels",
            "app_fee_money" => [
                "amount" => 3,
                "currency" => "USD"]]);

        if ($response->failed()) {
            return $response;
        } else {
            return $response;
        }

    }
    private function createCustomer($buyer)
    {

        $arr = array(
            'first_name' => $buyer->given_name,
            'last_name' => $buyer->family_name,
            'company_name' => $buyer->given_name . "" . $buyer->family_name,
            'nickname' => $buyer->given_name ?? '',
            'phone' => $buyer->phone ?? '',
            'note' => $buyer->note ?? '',
            'email' => $buyer->email,
        );
        $customer = new Customer($arr);
        // $customer->save();
        return $customer;

    }
    private function chargeWithCustomer(Customer $customer)
    {

        $transaction = Square::setCustomer($customer)
            ->charge([
                'amount' => '500',
                'card_nonce' => 'xxxxx',
                'location_id' => 'xxxxx',
                'currency' => 'USD',
                'source_id' => 'xxxxxx',
            ]);
        return $transaction;
    }
    public function labels(Request $request)
    {

        $id = auth()->user()->id;
        $user = User::find($id);
        //process data, find or create customer, create product, create plan
        $buyer = DB::table('boxes')
            ->join('users', 'users.id', '=', 'boxes.user_id')
            ->where('user_id', '=', $user->id)
            ->select('users.given_name', 'users.family_name',
                'boxes.address_line_1', 'users.email',
                'boxes.address_line_2', 'boxes.admin_area_1',
                'boxes.admin_area_2', 'boxes.country_code', 'boxes.postal_code')
            ->get();

        // $customer = self::createCustomer($buyer[0]);
        //self::charge();
    }

}
