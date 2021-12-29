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
use Shippo_Parcel;


class ShippingController extends Controller
{

    public function __construct()
    {
        $config = parse_ini_file( "../config/app.ini", true );
        $token = $config[ 'shippo' ][ 'token' ];
        Shippo::setApiKey($token);
    }

    public function rates(User $user, Request  $request)
    {

        if (json_decode($_SERVER[ "HTTP_TO" ])  !== null) {
            $to = json_decode($_SERVER[ "HTTP_TO" ]);
           dd($to);
        }else{
            echo "Missing header";
        }
        $id = $to->id;
        $user = User::find($id);
        $box = $user->boxes()->first();

        if (json_decode($_SERVER[ "HTTP_TO" ])  !== null) {
            $to = json_decode($_SERVER[ "HTTP_TO" ]);

        }else{
            echo "Missing header";
        }
        $id = $to->creator_id;
        $user = User::find($id);
        $box = $user->boxes()->first();

        if(isset($box) && $box->ship_from == 0) {
            $fromAddress = Shippo_Address::create( array(
                "name" => $box->name,
                "company" => env('APP_NAME'),
                "street1" => $box->address_line_1,
                "city" => $box->admin_area_2,
                "state" => $box->admin_area_1,
                "zip" => $box->postal_code,
                "country" => $box->country_code,
                "phone" => env('US_PHONE'),
                "email" => env('SERVICE_EMAIL')
                ) );
        }

        if(isset($box) && $box->ship_from == 1 ) {
            $config = parse_ini_file( "../config/app.ini", true );
            $fromAddress = Shippo_Address::create( array(
              "name" => 'SELLER', /* WARNING Get user_id from boxes table and
                                     use it to get fullname from users table  */
              "company" => "Boxeon",
              "street1" => $config[ 'boxeon' ][ 'address_line_1' ],
              "city" => $config[ 'boxeon' ][ 'admin_area_2' ],
              "state" => $config[ 'boxeon' ][ 'admin_area_1' ],
              "zip" => $config[ 'boxeon' ][ 'postal_code' ],
              "country" => $config[ 'boxeon' ][ 'country_code' ],
              "phone" => $config[ 'boxeon' ][ 'USPhone' ],
              "email" => $config[ 'boxeon' ][ 'serviceEmail' ]
            ) );
        }


        //$toAddress = (array)$to;

        $toAddress = Shippo_Address::create( array(
            "name" => $to->fullname,
            "company" => "Boxeon",
            "street1" => $to->address_line_1,
            "city" => $to->admin_area_2,
            "state" => $to->admin_area_1,
            "zip" => $to->postal_code,
            "country" => $to->country_code,
            "phone" => $config[ 'boxeon' ][ 'USPhone' ],
            "email" =>  $config[ 'boxeon' ][ 'serviceEmail' ]
          ) );

        // VALIDATE ADDRESS
       $toid = $toAddress[ 'object_id' ];
        $fromid = $fromAddress[ 'object_id' ];
       $vto = Shippo_Address::validate( $toid );
        $vfrom = Shippo_Address::validate( $fromid );// Get the shipment object

        // CREATE PARCEL OBJECT
        $parcel = Shippo_Parcel::create( array(
            "length" => $box->box_length,
            "width" => $box->box_width,
            "height" => $box->box_height,
            "distance_unit" => "in",
            "weight" => $box->box_weight,
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
        return $rates;
    }
}
