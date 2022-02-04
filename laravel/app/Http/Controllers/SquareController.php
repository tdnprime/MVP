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
     * Creates a one-time payment for shipping labe;s
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
            "note" => "Shipping labels",
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
    public function createCustomer()
    {

        $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($this->config['square']['customersEndpoint'], [

            "given_name" => "Amelia",
            "family_name" => "Earhart",
            "email_address" => "Amelia.Earhart@example.com",
            "address" => [
                "address_line_1" => "500 Electric Ave",
                "address_line_2" => "Suite 600",
                "locality" => "New York",
                "administrative_district_level_1" => "NY",
                "postal_code" => "10003",
                "country" => "US",
            ],
            "phone_number" => "1-212-555-4240",
            "reference_id" => "YOUR_REFERENCE_ID",
            "note" => "a customer",
        ]);

        if ($response->failed()) {
            return $response;
        } else {
            return "SUCCESS";
        }

    }
    public function createCard()
    {
        /*
    curl https://connect.squareupsandbox.com/v2/cards \
    -X POST \
    -H 'Square-Version: 2022-01-20' \
    -H 'Authorization: Bearer {ACCESS_TOKEN}' \
    -H 'Content-Type: application/json' \
    -d '{
    "idempotency_key": "{UNIQUE_KEY}",
    "source_id": "cnon:card-nonce-ok",
    "card": {
    "billing_address": {
    "address_line_1": "500 Electric Ave",
    "address_line_2": "Suite 600",
    "locality": "New York",
    "administrative_district_level_1": "NY",
    "postal_code": "94103",
    "country": "US"
    },
    "cardholder_name": "Jane Doe",
    "customer_id": "{CUSTOMER_ID}",
    "reference_id": "alternate-id-1"
    }
    }'
     */
    }
    public function createPlan($data)
    {

        $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($this->config['square']['plansEndpoint'], [

            "idempotency_key" => "af3d1afc-7212-4300-b463-0bfc5314a5ae",
            "object" => [
                "id" => "#Cocoa",
                "type" => "ITEM",
                "item_data" => [
                    "abbreviation" => "Ch",
                    "description" => "Hot Chocolate",
                    "name" => "Cocoa",
                    "variations" => [
                        [
                            "id" => "#Small",
                            "type" => "ITEM_VARIATION",
                            "item_variation_data" => [
                                "item_id" => "#Cocoa",
                                "name" => "Small",
                                "pricing_type" => "VARIABLE_PRICING",
                            ],
                        ],
                        [
                            "id" => "#Large",
                            "type" => "ITEM_VARIATION",
                            "item_variation_data" => [
                                "item_id" => "#Cocoa",
                                "name" => "Large",
                                "pricing_type" => "FIXED_PRICING",
                                "price_money" => [
                                    "amount" => 400,
                                    "currency" => "USD",
                                ],
                            ],
                        ],
                    ],
                ],
            ],

        ]);

        if ($response->failed()) {
            return $response;
        } else {
            return "SUCCESS";
        }

    }
    public function createSubscription()
    {
        return true;
        $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($this->config['square']['subscriptionsEndpoint'], [
            "idempotency_key" => $charge->sourceId,
            "plan_id" => $charge->sourceId,
            "customer_id" => true,
            "card_id" => $charge->locationId,
            "start_date" => "Shipping labels",
            "tax_percentage" => '',
            'timezone' => 'America/Los_Angeles',
            "source" => [
                "name" => "Boxeon",
            ]]);

        if ($response->failed()) {
            return $response;
        } else {
            return "SUCCESS";
        }

    }
    public function deleteSubscription()
    {
        $endpoint = "https://connect.squareup.com/v2/subscriptions/$sub->id/actions/$action_id";
        $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->delete($endpoint);

    }
    public function updateSubscription(Request $request)
    {
        /*
    {
    "merchant_id": "VSE65BA53PXCC",
    "type": "subscription.updated",
    "event_id": "c0b40cc0-7cb2-4aa1-81ce-0893b9b0b9b8",
    "created_at": "2020-07-15T05:14:11.213Z",
    "data": {
    "type": "subscription",
    "id": "592b9720-d2ef-4ee4-b3fd-9d98e4f829d2",
    "object": {
    "subscription": {
    "id": "592b9720-d2ef-4ee4-b3fd-9d98e4f829d2",
    "created_date": "2020-07-15",
    "customer_id": "QX2XG9GMQS2BVBJKPG8CJ8JKCR",
    "location_id": "EZHGJ7SNVAJ19",
    "plan_id": "CRUUZUK5W6PIIM6H54242NV6",
    "start_date": "2020-07-15",
    "status": "ACTIVE",
    "tax_percentage": "5",
    "timezone": "America/New_York",
    "version": 1594790050754
    }
    }
    }
    }
     */
    }

    public function __destruct()
    {
        delete($this->config);
    }

}
