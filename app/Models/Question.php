<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'tryout_id',
        'question',
        'question_image',
        'option_1',
        'option_1_image',
        'option_2',
        'option_2_image',
        'option_3',
        'option_3_image',
        'option_4',
        'option_4_image',
        'option_5',
        'option_5_image',
        'answer',
        'explanation',
        'explanation_image',
    ];

    public function tryout()
    {
        return $this->belongsTo(Tryout::class);
    }
}
