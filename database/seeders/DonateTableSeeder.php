<?php

namespace Database\Seeders;

use App\Models\Donate;
use Illuminate\Database\Seeder;

class DonateTableSeeder extends Seeder
{
    public function run(): void
    {
        Donate::create([
            'bank_name'    => 'BSI',
            'bank_number'  => '7249922368',
            'bank_account' => 'Larasati Disralyndi',
            'qrcode_name'  => 'LetStudy',
            'qrcode_nmid'  => 'ID1023262069876',
        ]);
    }
}
