<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaypalController extends Controller
{
    public function __construct(){
        //require_once dirname(__DIR__, 3) . '/php/paypal-connect.php';
        $config = parse_ini_file(dirname(__DIR__, 3) . 
        '/config/app.ini', true);
    }
    private function createProduct($id)
    {
       
        $endpoint = $config['paypal']['productsEndpoint'];
        $data = [
            'name' => 'A subscription box',
            'description' => 'Various products for entertainment purposes',
            'type' => 'PHYSICAL',
            'category' => 'ENTERTAINMENT_AND_MEDIA',
            'home_url' => 'https://boxeon.com', // Update
        ];
        $media = "Content-Type: application/json, Authorization: Bearer $token";
        $product = sendcurl(json_encode($data), $endpoint, $media); 

        $array = ['product_id' =>  $product['id']];

        $box = DB::table('boxes')
            ->where('user_id', $id)
            ->limit(1);
        $box->update($array);
    }

}
