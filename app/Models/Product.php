<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'title',
        'slug',
        'description',
    ];

    public function subProducts()
    {
        return $this->hasMany(SubProduct::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function sosmeds()
    {
        return $this->hasMany(Sosmed::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function bannerProducts()
    {
        return $this->hasMany(BannerProduct::class);
    }
}
