<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Shippo;
use Shippo_Address;
use Shippo_Parcel;
use Shippo_Shipment;

class ShippingController extends Controller
{

    public function __construct()
    {
        $config = parse_ini_file(dirname(__DIR__, 3) . "/config/app.ini", true);
        $token = $config['shippo']['token'];
        Shippo::setApiKey($token);
    }

    public function rates(Request $request)
    {

        if (gettype($request["to"]) == 'string') {
            $to = json_decode($request["to"]);

        } elseif (gettype($request["to"]) == 'object'){
            $to = $request["to"];
        }
        $id = $to->creator_id;
        $user = User::find($id);
        $box = $user->boxes()->first();

        $id = $to->creator_id;
        $user = User::find($id);
        $box = $user->boxes()->first();

        if (isset($box) && $box->ship_from == 0) {
            $fromAddress = Shippo_Address::create(array(
                "name" => $box->name,
                "company" => env('APP_NAME'),
                "street1" => $box->address_line_1,
                "city" => $box->admin_area_2,
                "state" => $box->admin_area_1,
                "zip" => $box->postal_code,
                "country" => $box->country_code,
                "phone" => env('US_PHONE'),
                "email" => env('SERVICE_EMAIL'),
            ));
        }

        if (isset($box) && $box->ship_from == 1) {
            $config = parse_ini_file(dirname(__DIR__, 3) . "/config/app.ini", true);
            $fromAddress = Shippo_Address::create(array(
                "name" => $box->name, 
                "company" => "Boxeon",
                "street1" => $config['boxeon']['address_line_1'],
                "city" => $config['boxeon']['admin_area_2'],
                "state" => $config['boxeon']['admin_area_1'],
                "zip" => $config['boxeon']['postal_code'],
                "country" => $config['boxeon']['country_code'],
                "phone" => $config['boxeon']['USPhone'],
                "email" => $config['boxeon']['serviceEmail'],
            ));
        }

        $toAddress = Shippo_Address::create(array(
            "name" => $to->fullname,
            "company" => "Boxeon",
            "street1" => $to->address_line_1,
            "city" => $to->admin_area_2,
            "state" => $to->admin_area_1,
            "zip" => $to->postal_code,
            "country" => $to->country_code,
            "phone" => $config['boxeon']['USPhone'],
            "email" => $config['boxeon']['serviceEmail'],
        ));

        $toid = $toAddress['object_id'];
        $fromid = $fromAddress['object_id'];
        // VALIDATE ADDRESS -- This will be done when purchasing shipping labels
        /*$vto = Shippo_Address::validate( $toid );
        $vfrom = Shippo_Address::validate( $fromid );//the shipment object
         */

        // CREATE PARCEL OBJECT
        $parcel = Shippo_Parcel::create(array(
            "length" => $box->box_length,
            "width" => $box->box_width,
            "height" => $box->box_height,
            "distance_unit" => "in",
            "weight" => $box->box_weight,
            "mass_unit" => "lb",
        ));

        $shipment = Shippo_Shipment::create(
            array(
                "address_from" => $fromid,
                "address_to" => $toid,
                "parcels" => $parcel,
                "async" => false,
            )
        );

        //GET SHIPPING RATES
        $sid = $shipment['object_id'];
        $rates = Shippo_Shipment::get_shipping_rates(
            array(
                'id' => $sid,
                'currency' => 'USD',
            )
        );

        $tmp = json_decode($rates);
        if ($tmp->count == 0) {return "Something went wrong.";} else {
            return $rates;
        }
    }
    public function ship()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $subscriptions = DB::table('subscriptions')
        ->where('creator_id', '=', $id)
        ->select('*')
        ->get();
        return view('subscription_box.ship', compact('user'))
            ->with('outgoing', count( $subscriptions));
    }


    public function update()
    {

        //
    }
    public function addresses(){
        $id = auth()->user()->id;
        $Addresses = DB::table('subscriptions')
        ->where('creator_id', '=', $id)
        ->where('status', '=', 1)
        ->where('order_id', '<>', null)
        ->where('rate_id', '<>', null)
        ->select('fullname', 'address_line_1',
        'address_line_2', 'admin_area_1',
        'admin_area_2', 'country_code', 'postal_code')
        ->get();
        return view('subscription_box.addresses', ['print'=>$Addresses]);
      }

}
