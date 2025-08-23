<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'logo' => asset('assets/media/logos/logo-letstudy-ptn.png'),
                'title' => 'LetStudy PTN',
                'slug' => Str::slug('LetStudy PTN'),
                'description' => 'LetStudy PTN hadir untuk mendampingi pelajar SMA/sederajat yang dalam mempersiapkan diri menghadapi seleksi masuk Perguruan Tinggi Negeri (PTN). Kami menyediakan bahan belajar SNBT dan Mandiri berkualitas serta Tryout secara gratis, dibimbing oleh tutor berpengalaman untuk membantumu lolos ujian masuk PTN',
            ],
            [
                'logo' => asset('assets/media/logos/logo-letstudy-english.png'),
                'title' => 'LetStudy English',
                'slug' => Str::slug('LetStudy English'),
                'description' => 'LetStudy English dirancang untuk membantumu mempelajari Grammar, TOEFL, dan IELTS secara mendalam melalui e-book yang lengkap dengan latihan soal, serta tryout secara gratis. Dengan dukungan materi yang terstruktur dan tutor andal, kamu bisa meningkatkan kemampuan bahasa Inggris untuk keperluan akademik maupun karier!',
            ],
            [
                'logo' => asset('assets/media/logos/logo-letstudy-karier.png'),
                'title' => 'LetStudy Karier',
                'slug' => Str::slug('LetStudy Karier'),
                'description' => 'LetStudy Career hadir sebagai solusi persiapan karier dengan menyediakan materi gratis untuk berbagai kebutuhan, mulai dari persiapan karir, seleksi BUMN, tes CPNS, hingga TPA Bappenas dan psikotes. Semua materi dirancang secara terstruktur untuk membantu kamu lebih siap dan percaya diri dalam menghadapi dunia kerja',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
