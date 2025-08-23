<?php

namespace Database\Seeders;

use App\Models\SubProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubProductTableSeeder extends Seeder
{
    public function run(): void
    {
        $subProducts = [
            [
                'product_id' => 1,
                'icon' => asset('assets/media/logos/icon-snbt-utbk.png'),
                'title' => 'SNBT / UTBK',
                'slug' => Str::slug('SNBT / UTBK'),
                'description' => 'Lorem ipsum dolor sit amet consectetur',
            ],
            [
                'product_id' => 1,
                'icon' => asset('assets/media/logos/icon-mandiri.png'),
                'title' => 'Mandiri',
                'slug' => Str::slug('Mandiri'),
                'description' => 'Lorem ipsum dolor sit amet consectetur',
            ],
            [
                'product_id' => 2,
                'icon' => asset('assets/media/logos/icon-ielts.png'),
                'title' => 'IELTS',
                'slug' => Str::slug('IELTS'),
                'description' => 'Lorem ipsum dolor sit amet consectetur',
            ],
            [
                'product_id' => 2,
                'icon' => asset('assets/media/logos/icon-toefl.png'),
                'title' => 'TOEFL',
                'slug' => Str::slug('TOEFL'),
                'description' => 'Lorem ipsum dolor sit amet consectetur',
            ],
            [
                'product_id' => 2,
                'icon' => asset('assets/media/logos/icon-grammar.png'),
                'title' => 'Grammar',
                'slug' => Str::slug('Grammar'),
                'description' => 'Lorem ipsum dolor sit amet consectetur',
            ],
            [
                'product_id' => 2,
                'icon' => asset('assets/media/logos/icon-study-abroad.png'),
                'title' => 'Study Abroad',
                'slug' => Str::slug('Study Abroad'),
                'description' => 'Lorem ipsum dolor sit amet consectetur',
            ],
            [
                'product_id' => 3,
                'icon' => asset('assets/media/logos/icon-management-trainee.png'),
                'title' => 'Management Trainee',
                'slug' => Str::slug('Management Trainee'),
                'description' => 'Lorem ipsum dolor sit amet consectetur',
            ],
            [
                'product_id' => 3,
                'icon' => asset('assets/media/logos/icon-tpa-bappenas.png'),
                'title' => 'TPA Bappenas',
                'slug' => Str::slug('TPA Bappenas'),
                'description' => 'Lorem ipsum dolor sit amet consectetur',
            ],
            [
                'product_id' => 3,
                'icon' => asset('assets/media/logos/icon-english-for-career.png'),
                'title' => 'English for Career',
                'slug' => Str::slug('English for Career'),
                'description' => 'Lorem ipsum dolor sit amet consectetur',
            ],
        ];

        foreach ($subProducts as $subProduct) {
            SubProduct::create($subProduct);
        }
    }
}
