<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SquareController extends Controller
{
    public $config;

    public function __construct()
    {
        $this->config = parse_ini_file(dirname(__DIR__, 3) .
            "/config/app.ini", true);

    }
    /*
     * Creates a one-time payment for shipping labels
     * Returns to /labels/generate
     */
    public function charge(Request $request)
    {

        $charge = json_decode($request['charge']);
        $amount = (int) $charge->amount * 100;

        $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($this->config['square']['paymentsEndpoint'], [
            "idempotency_key" => $charge->sourceId,
            "amount_money" => [
                "amount" => $amount,
                "currency" => "USD",
            ],
            "source_id" => $charge->sourceId,
            "autocomplete" => true,
            "location_id" => $charge->locationId,
            "note" => "Shipping labels", // make dynamic
            "app_fee_money" => [
                "amount" => 3,
                "currency" => "USD"]]);

        if ($response->status() == 200) {
            $completed = json_decode($response);
            if ($completed->payment->status == 'COMPLETED') {
                return json_encode(array('status' => 'SUCCESS'));
            } else {
                return json_encode(array('status' => 'FAILURE'));
            }
        } else {
            return json_encode(array('status' => 'FAILURE'));
        }

    }

    public function createCustomer(Request $request)
    {
        $request = json_decode($request);

        return $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($this->config['square']['customersEndpoint'], [

            "given_name" => $request->given_name,
            "family_name" => $request->family_name,
            "email_address" => $request->email,
            "address" => [
                "address_line_1" => $request->address_line_1,
                "address_line_2" => $request->address_line_2,
                "locality" => $request->admin_area_2,
                "administrative_district_level_1" => $request->admin_area_1,
                "postal_code" => $request->postal_code,
                "country" => $request->country_code,
            ],
            "cardholder_name" => $request->fullname,
            "customer_id" => $request->customer_id,
            "reference_id" => $request->id,
        ]);

    }

    public function createCard(Request $request)
    {
        $request = json_decode($request);

        return $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($this->config['square']['cardsEndpoint'], [

            "idempotency_key" => $request->source_id,
            "source_id" => $request->source_id,
            "card" => [
                "billing_address" => [
                    "address_line_1" => $request->address_line_1,
                    "address_line_2" => $request->address_line_2,
                    "locality" => $request->admin_area_2,
                    "administrative_district_level_1" => $request->admin_area_1,
                    "postal_code" => $request->postal_code,
                    "country" => $request->country_code,
                ],
                "cardholder_name" => $request->fullname,
                "customer_id" => $request->customer_id,
                "reference_id" => $request->id,
            ],
        ]);

    }

    public function createPlan($plan, $key)
    {
        
        $price = (int) $plan->amount * 100;


        return $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($this->config['square']['plansEndpoint'], [

            "idempotency_key" => $key,
            "object" => [
                "type" => "SUBSCRIPTION_PLAN",
                "id" => "#plan",
                "subscription_plan_data" => [

                    "name" => $plan->given_name . " " . $plan->family_name . " Subscription box",

                    "phases" => [
                        [
                            "cadence" => $plan->cadence, 
                            "recurring_price_money" => [
                                "amount" => $price,
                                "currency" => "USD",
                            ],
                        ],
                    ],
                ],
            ],

        ]);

    }

    public function createSubscription(Request $request)
    {

        $subscription = json_decode($request);
        return $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($this->config['square']['subscriptionsEndpoint'], [

            "idempotency_key" => $subscription->sourceId,
            "plan_id" => $subscription->sourceId,
            "customer_id" => $subscription->customer_id,
            "card_id" => $subscription->locationId,
            "start_date" => $subscription->created_at,
            "tax_percentage" => '5',
            'timezone' => 'America/New_York',
            "source" => [
                "name" => "Boxeon",
            ]]);


    }

    public function deleteSubscription(Request $request)
    {
        $subscription = json_decode( $request);
        $endpoint = $config['square']['subscriptionsEndpoint'] .
            "/$subscription->sub_id/actions/$subscription->action_id";

        return $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->delete($endpoint);

    }

    public function updateSubscription(Request $request)
    {
        return $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($this->config['square']['subscriptionsEndpoint'], [

            "merchant_id" => $request->merchant_id,
            "type" => "subscription.updated",
            "event_id" => $request->event_id,
            "created_at" => $request->created_at,
            "data" => [
                "type" => "subscription",
                "id" => $request->sub_id,
                "object" => [
                    "subscription" => [
                        "id" => $request->sub_id,
                        "created_date" => $request->created_at,
                        "customer_id" => $request->customer_id,
                        "location_id" => $config['square']['locationId'],
                        "plan_id" => $request->plan_id,
                        "start_date" => $request->createrd_at,
                        "status" => "ACTIVE",
                        "tax_percentage" => "5",
                        "timezone" => "America/New_York",
                        "version" => $request->vid,
                    ],
                ],
            ]]);

    }

    public function __destruct()
    {
        unset($this->config);
    }

}
