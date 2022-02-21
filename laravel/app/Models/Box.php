<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $primaryKey = 'vid';

    protected $fillable = [
        'user_id',
        'pre_order',
        'special_offer',
        'price',
        'box_url',
        'shipping_cost',
        'ship_from',
        'curation',
        'num_products',
        'box_weight',
        'box_length',
        'box_width',
        'box_supply',
        'in_stock',
        'box_height',
        'prodname',
        'proddesc',
        'product_id',
        'address_line_1',
        'address_line_2',
        'admin_area_1',
        'admin_area_2',
        'postal_code',
        'country_code',
        'video',
        'shipping_count',
        'page_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

   
}
