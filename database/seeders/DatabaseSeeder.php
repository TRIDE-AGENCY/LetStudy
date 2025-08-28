<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserTableSeeder::class);
        $this->call(DonateTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(SubProductTableSeeder::class);
        $this->call(SosmedTableSeeder::class);
        $this->call(LegalTableSeeder::class);
        $this->call(ReportTableSeeder::class);
        $this->call(QuoteTableSeeder::class);
        $this->call(BannerProductTableSeeder::class);
        $this->call(ProfileTableSeeder::class);
        $this->call(LocationTableSeeder::class);
    }
}
