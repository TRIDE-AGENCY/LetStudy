<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'about',
        'phone',
        'email',
        'whatsapp_community',
        'telegram_community'
    ];
}
