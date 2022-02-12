<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id',
        'uid',
        'given_name',
        'family_name',
        'cpf',
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
        'card_id',
        'last_shipping',
        'label',
        'carrier'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDateFormat()
    {
        return 'U';
    }

}
