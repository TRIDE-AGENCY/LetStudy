<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProductBenefit extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_product_id',
        'benefit'
    ];

    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class);
    }
}
