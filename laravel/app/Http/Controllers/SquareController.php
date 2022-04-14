<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SubscriptionController;
use App\Jobs\SendEmailJob;
use App\Mail\OrderPlaced;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class SquareController extends Controller
{
    public $config;

    public function __construct()
    {

        $this->config = parse_ini_file(dirname(__DIR__, 3) .
            "/config/app.ini", true);

    }

    public function test()
    {
        return redirect('/home/subscriptions');

        $id = auth()->user()->id;
        $user = User::find($id);

        return new OrderPlaced($user);

        #Queue an order-placed system email
        $details['email'] = $user->email;
        $message = new OrderPlaced($user);
        SendEmailJob::dispatch($details, $message)->onQueue('emails');
        dd($response);
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
            "note" => "Shipping labels", // make dynamic - change, not urgent
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
        $subscription = Subscription::where('user_id', '=', $id)
            ->orderByDesc('created_at')
            ->limit(1)
            ->get();

        $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($this->config['square']['customersEndpoint'], [

            "given_name" => $subscription[0]['billing_given_name'] ?? $subscription[0]['given_name'],
            "family_name" => $subscription[0]['billing_family_name'] ?? $subscription[0]['family_name'],
            "email_address" => $user->email,
            "address" => [
                "address_line_1" => $subscription[0]['billing_address_line_1'] ?? $subscription[0]['address_line_1'],
                "address_line_2" => $subscription[0]['billing_address_line_2'] ?? $subscription[0]['address_line_2'] ?? "",
                "locality" => $subscription[0]['billing_admin_area_2'] ?? $subscription[0]['admin_area_2'],
                "administrative_district_level_1" => $subscription[0]['billing_admin_area_1'] ?? $subscription[0]['admin_area_1'],
                "postal_code" => $subscription[0]['billing_postal_code'] ?? $subscription[0]['postal_code'],
                "country" => $subscription[0]['billing_country_code'] ?? $subscription[0]['country_code'],
            ],
            "cardholder_name" => $subscription[0]['billing_ given_name'] ?? $subscription[0]['given_name'] . "" . $subscription[0]['billing_family_name'] ?? $subscription[0]['family_name'],
            "reference_id" => '#early',
        ]);
        return json_decode($response);

    }

    public function createPayment($request)
    {

        $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($this->config['square']['paymentsEndpoint'], [

            "idempotency_key" => $request['source_id'],
            "amount_money" => [
                "amount" => $request['amount'],
                "currency" => "USD",
            ],
            "source_id" => $request['source_id'],
            "autocomplete" => true,
            "location_id" => $this->config['square']['locationId'],
            "reference_id" => "creator-id-" . $request['id'],

        ]);

        $created = json_decode($response);

        if (isset($created->payment->id)) {

            return $created->payment->id;

        } else {

            return false;
        }

    }

    public function createCard($request)
    {

        $id = auth()->user()->id;
        $user = User::find($id);

        $subscription = Subscription::where('user_id', '=', $id)
            ->orderByDesc('created_at')
            ->limit(1)
            ->get();

        $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($this->config['square']['cardsEndpoint'], [

            "idempotency_key" => $request['source_id'],
            "source_id" => $request['source_id'],
            "card" => [
                "billing_address" => [
                    "address_line_1" => $subscription[0]['billing_address_line_1'] ?? $subscription[0]['address_line_1'],
                    "address_line_2" => $subscription[0]['billing_address_line_2'] ?? $subscription[0]['address_line_2'] ?? "",
                    "locality" => $subscription[0]['billing_admin_area_2'] ?? $subscription[0]['admin_area_2'],
                    "administrative_district_level_1" => $subscription[0]['billing_admin_area_1'] ?? $subscription[0]['admin_area_1'],
                    "postal_code" => $subscription[0]['billing_postal_code'] ?? $subscription[0]['postal_code'],
                    "country" => $subscription[0]['billing_country_code'] ?? $subscription[0]['country_code'],
                ],
                "cardholder_name" => $request['fullname'],
                "customer_id" => $request['customer_id'],
                "reference_id" => "creator-id-" . $request['id'],
            ],

        ]);

        return json_decode($response);

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

        $sub = Subscription::where('user_id', '=', $id)
            ->orderByDesc('created_at')
            ->limit(1)
            ->get();

        $subscription = json_decode($request['upsert']);
        $price = SubscriptionController::amount();

        // Checkpoint 1.
        $payment_id = self::createPayment([

            'source_id' => $subscription->sourceId,
            'amount' => $price['amount'] * 100,
            'id' => $sub[0]['creator_id'],

        ]);

        if ($payment_id == false) {

         /*   Subscription::where('user_id', '=', $id)
                ->orderByDesc('created_at')
                ->limit(1)
                ->delete();

                */

            return json_encode(array('status' => 'FAILURE'));

        }

        // Checkpoint 2.
        if (!isset($user->customer_id)) {

            $new = self::createCustomer();

            if (isset($new->customer->id)) {

                $user->update([

                    'customer_id' => $new->customer->id,
                ]);

            } else {

                return json_encode(array('status' => 'FAILURE'));

            }
        }

        // Reload
        $user = User::find($id);

        // Checkpoint 3.
        $saved = self::createCard([

            'source_id' => $payment_id,
            'fullname' => $sub[0]['billing_given_name'] ?? $sub[0]['given_name'] . "" . $sub[0]['billing_family_name'] ?? $sub[0]['family_name'],
            'customer_id' => $user->customer_id,
            'id' => $sub[0]['creator_id'],

        ]);

        if (!isset($saved->card->id)) {

            return json_encode(array('status' => 'FAILURE'));
        }

        // Create the subscription
        $created_at = $sub[0]['created_at']->format('Y-m-d');
        $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->post($this->config['square']['subscriptionsEndpoint'], [

            "idempotency_key" => $subscription->sourceId,
            "plan_id" => $sub[0]['plan_id'],
            "customer_id" => $user->customer_id,
            "card_id" => $saved->card->id,
            "location_id" => $this->config['square']['locationId'],
            "start_date" => $created_at,
            "tax_percentage" => '0',
            'timezone' => 'America/New_York',
            "source" => [
                "name" => "Boxeon",
            ]]);

        $response = json_decode($response);

        if (isset($response->subscription->id)) {

            Subscription::where('user_id', '=', $id)
                ->where('creator_id', '=', $sub[0]['creator_id'])
                ->where('plan_id', '=', $sub[0]['plan_id'])
                ->update([

                    'sub_id' => $response->subscription->id,
                    'card_id' => $response->subscription->card_id,
                    'status' => 1,
                    'square_vid' => $response->subscription->version,
                ]);

            $stock = new SubscriptionController();
            $stock->updateStock(

                $sub[0]['creator_id'], $sub[0]['version'], $sub[0]['stock']
            );

            #Queue an order placed system email
            $details['email'] = $user->email;
            $message = new OrderPlaced($user);
            SendEmailJob::dispatch($details, $message)->onQueue('emails');

            Session::flash('message', 'Thank you!');
            return json_encode(array('redirectTo' => '/home/subscriptions'));

        } else {

            return $response;
        }

    }

    public function deleteSubscription($request)
    {

        $endpoint = $this->config['square']['subscriptionsEndpoint'] . "/" . $request['sub_id'] . "/cancel";

        return $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->put($endpoint);

    }

    public function updateSubscription($request)
    {

        $response = Http::withHeaders(
            [
                'Authorization' => "Bearer " . $this->config['square']['access_token'],
                'Content-Type' => 'application/json',
                'Square-Version' => "2022-01-20",
            ]
        )->put($this->config['square']['subscriptionsEndpoint'] . "/" . $request['sub_id'], [

            "subscription" => [
                "cadence" => $request['cadence'],
                "version" => $request['square_vid'],
            ],
        ]);

        return json_decode($response);

    }

    public function __destruct()
    {
        unset($this->config);
    }

}
