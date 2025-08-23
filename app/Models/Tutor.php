<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ebook_id',
        'name',
        'title',
        'education',
        'photo',
        'achievement',
    ];

    public function ebook()
    {
        return $this->belongsTo(Ebook::class);
    }
}
