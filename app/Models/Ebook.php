<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_product_id',
        'title',
        'slug',
        'id_ebook',
        'id_form',
        'launch_date',
        'total_pages',
        'image',
        'description',
        'benefit'
    ];

    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class);
    }

    public function banner()
    {
        return $this->hasOne(Banner::class);
    }

    public function tutors()
    {
        return $this->hasMany(Tutor::class);
    }
}
