<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\Shipping;
use Shippo;
use App\Models\User;
use App\Models\Box;
use Shippo_Address;
use Shippo_Shipment;
use Shippo_Transaction;


class ShippingController extends Controller
{

    public function __construct()
    {
        // Grab this private key from
        // .env and setup the Shippo api
       Shippo::setApiKey(env('SHIPPO_PRIVATE'));
    }

    public function rates(User $user, Request  $request)
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $box = $user->boxes()->first();

        dd($request->all());

        if ( $request->json_decode($_SERVER[ "HTTP_CALC" ])  !== null) {
            $to = json_decode($_SERVER[ "HTTP_CALC" ]);

            dd($to);
        }else{
            echo "missing header";
        }


        if(isset($box) && $box->ship_from == 0) {
            $fromAddress = Shippo_Address::create( array(
                "name" => $box->name,
                "company" => env('APP_NAME'),
                "street1" => $box->street1,
                "city" => $box->admin_area_2,
                "state" => $box->admin_area_1,
                "zip" => $box->postal_code,
                "country" => $box->country_code,
                "phone" => env('US_PHONE'),
                "email" => env('SERVICE_EMAIL')
                ) );
        }

        if(isset($box) && $box->ship_from == 1 ) {
            $fromAddress = Shippo_Address::create( array(
                "name" => $box->name,
                "company" => env('APP_NAME'),
                "street1" => $box->street1,
                "city" => $box->admin_area_2,
                "state" => $box->admin_area_1,
                "zip" => $box->postal_code,
                "country" => $box->country_code,
                "phone" => env('US_PHONE'),
                "email" => env('SERVICE_EMAIL')
                ) );
        }

        // Grab the shipping address from the User model
        $toAddress = $user->shippingAddress();
        // Pass the PURCHASE flag.
        $toAddress['object_purpose'] = 'PURCHASE';

        // VALIDATE ADDRESS
        $toid = $toAddress[ 'object_id' ];
        $fromid = $fromAddress[ 'object_id' ];
        $vto = Shippo_Address::validate( $toid );
        $vfrom = Shippo_Address::validate( $fromid );// Get the shipment object

        // CREATE PARCEL OBJECT
        $parcel = Shippo_Parcel::create( array(
            "length" => $re[ 0 ][ 'box_length' ],
            "width" => $re[ 0 ][ 'box_width' ],
            "height" => $re[ 0 ][ 'box_height' ],
            "distance_unit" => "in",
            "weight" => $re[ 0 ][ 'box_weight' ],
            "mass_unit" => "lb",
        ) );

        $shipment = Shippo_Shipment::create(
            array(
            "address_from" => $fromid,
            "address_to" => $toid,
            "parcels" => $parcel,
            "async" => false
            )
        );

        //GET SHIPPING RATES
        $sid = $shipment[ 'object_id' ];
        $rates = Shippo_Shipment::get_shipping_rates(
            array(
            'id' => $sid,
            'currency' => 'USD'
            )
        );

        // The $rates is a complete object but for our view we
        // only need the rates_list items and will pass that to it
        return redirect()->back()->compact(['rates' => $rates->rates_list]);
    }
}
