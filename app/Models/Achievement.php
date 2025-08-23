<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'title',
        'value',
    ];


    public function donatesAsAchievement1()
    {
        return $this->hasMany(Donate::class, 'achievement1_id');
    }

    public function donatesAsAchievement2()
    {
        return $this->hasMany(Donate::class, 'achievement2_id');
    }

    public function donatesAsAchievement3()
    {
        return $this->hasMany(Donate::class, 'achievement3_id');
    }
}
