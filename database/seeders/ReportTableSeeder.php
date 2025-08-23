<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportTableSeeder extends Seeder
{
    public function run(): void
    {
        Report::create([
            'heading'      => 'Dengan bangga kami mempersembahkan Impact Report LetStudy 2023-2024',
            'sub_heading'  => 'Laporan ini merangkum langkah LetStudy dalam mendukung pendidikan, memberdayakan pelajar, dan membangun masa depan yang lebih cerah. Ke depannya, kami berkomitmen untuk terus memperluas dampak dan menjangkau lebih banyak pelajar serta komunitas.',
            'id_report'    => '123',
            'image'        => asset('assets/media/images/impact-report-book.png'),
        ]);
    }
}
