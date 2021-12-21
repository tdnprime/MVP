<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcription extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id',
        'user_id',
        'fullname',
        'cfp',
        'sub_id',
        'date_created',
        'version',
        'price',
        'frequency',
        'status',
        'tracking',
        'address_line_1',
        'address_line_2',
        'admin_area_1',
        'admin_area_2',
        'postal_code',
        'country_code',
        'rate_id',
        'rate',
        'shipment',
        'plan_id',
        'last_shipping',
        'label',
        'carrier'
    ];
}
