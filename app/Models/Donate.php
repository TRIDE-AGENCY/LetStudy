<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donate extends Model
{
    use HasFactory;

    protected $fillable = [
        'achievement1_id',
        'achievement2_id',
        'achievement3_id',
        'bank_name',
        'bank_number',
        'bank_account',
        'qrcode_image',
        'qrcode_name',
        'qrcode_nmid',
    ];

    public function achievement1()
    {
        return $this->belongsTo(Achievement::class, 'achievement1_id');
    }

    public function achievement2()
    {
        return $this->belongsTo(Achievement::class, 'achievement2_id');
    }

    public function achievement3()
    {
        return $this->belongsTo(Achievement::class, 'achievement3_id');
    }
}
