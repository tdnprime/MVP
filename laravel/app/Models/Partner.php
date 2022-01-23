<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'platform',
        'views',
        'country_code',

    ];
}
