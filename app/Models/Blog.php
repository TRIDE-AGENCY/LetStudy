<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_product_id',
        'title',
        'slug',
        'image',
        'content',
        'status',
        'is_featured',
    ];

    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class);
    }
}
