<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    public function run(): void
    {
        Profile::create([
            'about'     => '...',
            'phone'     => '...',
            'email'     => '...',
            'community' => '...',
        ]);
    }
}
