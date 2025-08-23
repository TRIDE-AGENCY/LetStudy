<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Seeder;

class QuoteTableSeeder extends Seeder
{
    public function run(): void
    {
        $quotes = [
            [
                'product_id' => null,
                'name'       => '...',
                'title'      => '...',
                'quote'      => '...',
            ],
            [
                'product_id' => 1,
                'name'       => '...',
                'title'      => '...',
                'quote'      => '...',
            ],
            [
                'product_id' => 2,
                'name'       => '...',
                'title'      => '...',
                'quote'      => '...',
            ],
            [
                'product_id' => 3,
                'name'       => '...',
                'title'      => '...',
                'quote'      => '...',
            ],
        ];

        foreach ($quotes as $data) {
            Quote::create($data);
        }
    }
}
