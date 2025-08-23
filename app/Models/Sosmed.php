<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sosmed extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'instagram',
        'youtube',
        'tiktok',
        'linkedin',
        'x',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
