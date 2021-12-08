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
        'curation',
        'category',
        'description',
        'box_weight',
        'price',
        'ship_from',
        'box_height',
        'box_length',
        'box_width',
        'box_supply',
        'in_stock',
        'num_products',
        'promo_code',
        'promo_supply',
        'promo_in_stock',
        'video',
        'product_id',
        'address_line_1',
        'address_line_2',
        'admin_area_1',
        'admin_area_2',
        'country_code',
        'postal_code',
        'plan_ids',
        'page_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
