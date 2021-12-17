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
        'curation',
        'num_products',
        'box_weight',
        'box_length',
        'box_width',
        'box_height',
        'prodname',
        'proddesc',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
