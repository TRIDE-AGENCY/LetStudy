<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'tryout_id',
        'user_id',
        'duration',
        'start_time',
        'end_time',
        'total_correct',
        'grade',
    ];

    public function tryout()
    {
        return $this->belongsTo(Tryout::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
