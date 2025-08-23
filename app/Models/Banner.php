<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'ebook_id',
        'heading',
        'sub_heading',
        'image',
    ];

    public function ebook()
    {
        return $this->belongsTo(Ebook::class);
    }
}
