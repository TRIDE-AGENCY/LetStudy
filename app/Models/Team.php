<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'name',
        'department',
        'status',
        'position',
        'bio',
        'quote',
        'email',
        'linkedin',
        'instagram',
        'tiktok',
        'x',
    ];
}
