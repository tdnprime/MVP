<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'given_name',
        'family_name',
        'email',
        'password',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function boxes()
    {
        return $this->hasOne(Box::class);
    }

    public function shippingAddress()
    {
        return [
            'name' => $this->name, 
            'company' => env('APP_NAME'),
            'street1' => $this->boxes()->address_line_1,
            'city' => $this->boxes()->admin_area_2,
            'state' => $this->boxes()->admin_area_1,
            'zip' => $this->boxes()->postal_code,
            'country' => $this->boxes()->country_code,
            'phone' => env('US_PHONE'),
            'email' => env('SERVICE_EMAIL'),
        ];
    }
}