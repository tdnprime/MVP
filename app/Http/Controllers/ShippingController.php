<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\Shipping;
use App\Models\User;
use App\Models\Box;
use Illuminate\Support\Facades\DB;


class ShippingController extends Controller
{

    public function rates(User $user, Box $box)
    {
        $id = auth()->user()->id; //  WARNING: Must be the seller's user id
        $user = User::find($id);
        $box = DB::table('boxes')->where('user_id', '=', $id)->get();


        dd($user->boxes()->first());
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
            $config = parse_ini_file( "../../config/app.ini", true );
            $fromAddress = Shippo_Address::create( array(
              "name" => ' I AM THE SELLER', // WARNING Get user_id from boxes table and 
                                            //use it to get fullname from users table
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

        // Grab the shipping address from the User model
       $toAddress = $user->shippingAddress();    // Pass the PURCHASE flag.
       $toAddress['object_purpose'] = 'PURCHASE';

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
        return redirect()->back()->compact(['rates' => $rates]);
        
    }
}
