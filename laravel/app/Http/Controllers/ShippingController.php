<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Shippo;
use Shippo_Address;
use Shippo_Parcel;
use Shippo_Shipment;

class ShippingController extends Controller
{
    public $config;

    public function __construct()
    {
        $this->config = parse_ini_file(dirname(__DIR__, 3) . "/config/app.ini", true);
        $token = $this->config['shippo']['token'];
        Shippo::setApiKey($token);
    }

    public function rates(Request $request)
    {

        $to = json_decode($request["to"]);

        $fromAddress = Shippo_Address::create(array(
            "name" => $box->name,
            "company" => "Boxeon.com",
            "street1" => $this->config['boxeon']['address_line_1'],
            "city" => $this->config['boxeon']['admin_area_2'],
            "state" => $this->config['boxeon']['admin_area_1'],
            "zip" => $this->config['boxeon']['postal_code'],
            "country" => $this->config['boxeon']['country_code'],
            "phone" => $this->config['boxeon']['USPhone'],
            "email" => $this->config['boxeon']['serviceEmail'],
        ));

        $toAddress = Shippo_Address::create(array(
            "name" => $to->given_name . "" . $to->family_name,
            "company" => "",
            "street1" => $to->address_line_1,
            "city" => $to->admin_area_2,
            "state" => $to->admin_area_1,
            "zip" => $to->postal_code,
            "country" => $to->country_code,
            "phone" => $this->config['boxeon']['USPhone'],
            "email" => $this->config['boxeon']['serviceEmail'],
        ));

        $toid = $toAddress['object_id'];
        $fromid = $fromAddress['object_id'];

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
        return view('shipping.ship', compact('user'))
            ->with('outgoing', count($subscriptions));
    }

    public function addresses()
    {

        $id = auth()->user()->id;
        $user = User::find($id);

        $Addresses = DB::table('subscriptions')
            ->where('creator_id', '=', $id)
            ->where('status', '=', 1)
            ->where('sub_id', '<>', null)
            ->where('rate_id', '<>', null)
            ->select('given_name', 'family_name', 'address_line_1',
                'address_line_2', 'admin_area_1',
                'admin_area_2', 'country_code', 'postal_code')
            ->get();

        if (count($Addresses) == 0) {

            Session::flash('message', 'No addresses found');
            return view("shipping.ship", compact('user', $user));

        } else {

            return view('box.addresses', ['print' => $Addresses]);
        }

    }

    public function __destruct()
    {

        unset($this->config);
    }

}
