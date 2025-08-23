<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_product_id',
        'title',
        'id_playlist',
        'thumbnail',
        'description',
    ];

    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class);
    }

    public function playlistVideos()
    {
        return $this->hasMany(PlaylistVideo::class)->orderBy('id', 'ASC');
    }
}
