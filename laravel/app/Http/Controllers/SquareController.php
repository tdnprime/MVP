<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
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
        $token = $this->$config['square']['access_token'];

        $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $token,
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

    public function createCustomer()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $subscription = Subscription::where('user_id', '=', $id)->get();

        $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($this->config['square']['customersEndpoint'], [

            "given_name" => $user->given_name,
            "family_name" => $user->family_name,
            "email_address" => $user->email,
            "address" => [
                "address_line_1" => $subscription[0]['address_line_1'],
                "address_line_2" => $subscription[0]['address_line_2'] ?? "",
                "locality" => $subscription[0]['admin_area_2'],
                "administrative_district_level_1" => $subscription[0]['admin_area_1'],
                "postal_code" => $subscription[0]['postal_code'],
                "country" => $subscription[0]['country_code'],
            ],
            "cardholder_name" => $subscription[0]['fullname'], // verify with user
            "reference_id" => '#early',
        ]);
        return json_decode($response);

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

    public function createPlan($plan)
    {

        $price = (int) $plan->amount * 100;

        return $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($this->config['square']['plansEndpoint'], [

            "idempotency_key" => $plan->key,
            "object" => [
                "type" => "SUBSCRIPTION_PLAN",
                "id" => "#plan",
                "subscription_plan_data" => [
                    "name" => "Subscription box",
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
        $id = auth()->user()->id;
        $user = User::find($id);
        $sub = Subscription::where('user_id', '=', $id)->get();

        if (!isset($user->customer_id)) {

            $new = self::createCustomer();
            if (isset($new->customer->id)) {
                $user->update(['customer_id' => $new->customer->id]);
            }

        }

        $subscription = json_decode($request['upsert']);

        $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($this->config['square']['subscriptionsEndpoint'], [

            "idempotency_key" => $subscription->sourceId,
            "plan_id" => $sub[0]['plan_id'],
            "customer_id" => $new->customer->id,
            "card_id" => $subscription->locationId,
            "start_date" => $sub[0]['created_at'],
            "tax_percentage" => '5',
            'timezone' => 'America/New_York',
            "source" => [
                "name" => "Boxeon",
            ]]);

        return json_decode($response);

    }

    public function deleteSubscription(Request $request)
    {
        $subscription = json_decode($request);
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
