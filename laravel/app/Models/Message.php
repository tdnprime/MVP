<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'sender',
        'recipient',
        'body',
    
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
