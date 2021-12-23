<?php
namespace App\Services;

use Shippo;

class Shipping
{
    public function __construct()
    {
        // Grab this private key from
        // .env and setup the Shippo api
        Shippo::setApiKey(env('SHIPPO_PRIVATE'));
    }
}
