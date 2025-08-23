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
        'is_random_question',
        'is_random_answer',
        'is_show_answer',
        'is_show_explanation',
        'is_show_rank',
        'status',
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

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
