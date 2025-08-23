<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'playlist_id',
        'title',
        'id_video',
        'thumbnail',
        'description',
    ];

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
}
