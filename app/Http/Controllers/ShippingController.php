<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function rates() {


        $config = parse_ini_file( "../config/app.ini", true );
        $to = json_decode( $_SERVER[ "HTTP_CALC" ] );
        $uid = $to->creator_id;

        // GET BOX DIMENSIONS + SHIPPERS ADDRESS

        // SETUP Expensive Shippo code
        $token = $config[ 'shippo' ][ 'token' ];
        require_once "../shippo/master/lib/Shippo.php";
        Shippo::setApiKey( $token );

        // CREATE ADDRESS OBJECTS
        require_once "../mysqliclass.php";
        $db = Database::getInstance();
        $re = $db->get( "SELECT * FROM boxes WHERE uid=$uid" );

        // SAVE ADDRESS TO SESSION FOR ENDING SUBSCRIPTION FLOW LATER
            session_start();
            $_SESSION['fullname'] = $to->name;
            $_SESSION['address_line_1']  = $to->address_line_1;
            if(isset($to->address_line_2)){ $_SESSION['address_line_2']  = $to->address_line_2;}
            $_SESSION['admin_area_2'] = $to->admin_area_2;
            $_SESSION['admin_area_1'] = $to->admin_area_1;
            $_SESSION['postal_code'] = $to->postal_code;
        $_SESSION['country_code'] = $to->country_code;

        if ( isset( $re[ 0 ] ) && $re[ 0 ][ 'ship_from' ] == 0 ) {

            $r = $db->get( "SELECT fullname FROM user  WHERE uid='$uid'" );
            $fromAddress = Shippo_Address::create( array(
            "name" => $r[ 0 ][ 'fullname' ],
            "company" => "Boxeon",
            "street1" => $re[ 0 ][ 'address_line_1' ],
            "city" => $re[ 0 ][ 'admin_area_2' ],
            "state" => $re[ 0 ][ 'admin_area_1' ],
            "zip" => $re[ 0 ][ 'postal_code' ],
            "country" => $re[ 0 ][ 'country_code' ],
            "phone" => $config[ 'boxeon' ][ 'USPhone' ],
            "email" => $config[ 'boxeon' ][ 'serviceEmail' ]
            ) );
        }
        if ( isset( $re[ 0 ] ) && $re[ 0 ][ 'ship_from' ] == 1 ) {

            $r = $db->get( "SELECT fullname FROM user  WHERE uid='$uid'" );
            $fromAddress = Shippo_Address::create( array(
            "name" => $r[ 0 ][ 'fullname' ],
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

        $endpoint = 'https://api.goshippo.com/addresses/';
        $toAddress = Shippo_Address::create( array(
            "name" => $to->name,
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
        $vfrom = Shippo_Address::validate( $fromid );
        //print_r($vto['validation_results']['is_valid']);

        // CREATE PARCEL OBJECT
        $parcel = Shippo_Parcel::create( array(
            "length" => $re[ 0 ][ 'box_length' ],
            "width" => $re[ 0 ][ 'box_width' ],
            "height" => $re[ 0 ][ 'box_height' ],
            "distance_unit" => "in",
            "weight" => $re[ 0 ][ 'box_weight' ],
            "mass_unit" => "lb",
        ) );

        // IF NEEDED, CREATE CUSTOMS DECLARATION IN PURCHASING OF LABELS

        /*$customs_item = array(
            'description'=> 'T-Shirt',
            'quantity'=> '20',
            'net_weight'=> '1',
            'mass_unit'=> 'lb',
            'value_amount'=> '200',
            'value_currency'=> 'USD',
            'origin_country'=> 'US');

        $customs_declaration = Shippo_CustomsDeclaration::create(
        array(
            'contents_type'=> 'MERCHANDISE',
            'contents_explanation'=> 'T-Shirt purchase',
            'non_delivery_option'=> 'RETURN',
            'certify'=> 'true',
            'certify_signer'=> 'Simon Kreuz',
            'items'=> array($customs_item)
        ));*/

        // CREATE SHIPMENT OBJECT
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

        return
        $rates;
    }
}
