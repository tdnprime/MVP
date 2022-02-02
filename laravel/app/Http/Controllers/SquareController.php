<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SquareController extends Controller
{
    public function charge(Request $request)
    {

        $charge = json_decode($request['charge']);
        $amount = (int) $charge->amount * 100;
        $config = parse_ini_file(dirname(__DIR__, 3) .
            "/config/app.ini", true);
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
    public function createPlan()
    {

    }
    public function createSubscription()
    {

    }
    public function deleteSubscription()
    {

    }

}
