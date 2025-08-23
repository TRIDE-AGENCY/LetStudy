<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tryout extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_product_id',
        'title',
        'slug',
        'description',
        'instruction',
        'duration',
        'start_time',
        'end_time',
        'random_question',
        'random_answer',
        'show_answer',
        'show_explanation',
        'show_rank',
    ];

    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('id', 'DESC');
    }

    public function tryoutGroups()
    {
        return $this->hasMany(TryoutGroup::class);
    }
}
