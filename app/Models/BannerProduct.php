<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'heading',
        'sub_heading',
        'image',
    ];
}
