<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LegalTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('legals')->insert([
            ['type' => 'terms'],
            ['type' => 'privacy'],
        ]);
    }
}
