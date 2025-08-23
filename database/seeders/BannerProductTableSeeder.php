<?php

namespace Database\Seeders;

use App\Models\BannerProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerProductTableSeeder extends Seeder
{
    public function run(): void
    {
        $bannerProducts = [
            [
                'product_id'  => 1,
                'heading'     => '...',
                'sub_heading' => '...',
                'image'       => asset('assets/media/images/banner-product.png'),
            ],
            [
                'product_id'  => 2,
                'heading'     => '...',
                'sub_heading' => '...',
                'image'       => asset('assets/media/images/banner-product.png'),
            ],
            [
                'product_id'  => 3,
                'heading'     => '...',
                'sub_heading' => '...',
                'image'       => asset('assets/media/images/banner-product.png'),
            ],
        ];

        foreach ($bannerProducts as $data) {
            BannerProduct::create($data);
        }
    }
}
