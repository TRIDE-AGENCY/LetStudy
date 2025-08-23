<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'icon',
        'title',
        'slug',
        'description',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function subProductBenefits()
    {
        return $this->hasMany(SubProductBenefit::class);
    }

    public function ebooks()
    {
        return $this->hasMany(Ebook::class);
    }

    public function tryouts()
    {
        return $this->hasMany(Tryout::class);
    }

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
