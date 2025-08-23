<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'title',
        'photo',
        'testimonial',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
