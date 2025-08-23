<?php

namespace Database\Seeders;

use App\Models\Sosmed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SosmedTableSeeder extends Seeder
{
    public function run(): void
    {
        $sosmeds = [
            [
                'product_id' => null,
                'instagram'  => 'https://instagram.com/letstudy',
                'youtube'    => 'https://youtube.com/@letstudy',
                'tiktok'     => 'https://tiktok.com/@letstudy',
                'linkedin'   => 'https://linkedin.com/company/letstudy',
                'x'          => 'https://x.com/letstudy',
            ],
            [
                'product_id' => 1,
                'instagram'  => 'https://instagram.com/letstudyptn',
                'youtube'    => 'https://youtube.com/@letstudyptn',
                'tiktok'     => 'https://tiktok.com/@letstudyptn',
                'linkedin'   => 'https://linkedin.com/company/letstudyptn',
                'x'          => 'https://x.com/letstudyptn',
            ],
            [
                'product_id' => 2,
                'instagram'  => 'https://instagram.com/letstudyenglish',
                'youtube'    => 'https://youtube.com/@letstudyenglish',
                'tiktok'     => 'https://tiktok.com/@letstudyenglish',
                'linkedin'   => 'https://linkedin.com/company/letstudyenglish',
                'x'          => 'https://x.com/letstudyenglish',
            ],
            [
                'product_id' => 3,
                'instagram'  => 'https://instagram.com/letstudykarier',
                'youtube'    => 'https://youtube.com/@letstudykarier',
                'tiktok'     => 'https://tiktok.com/@letstudykarier',
                'linkedin'   => 'https://linkedin.com/company/letstudykarier',
                'x'          => 'https://x.com/letstudykarier',
            ],
        ];

        foreach ($sosmeds as $data) {
            Sosmed::create($data);
        }
    }
}
