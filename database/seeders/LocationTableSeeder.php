<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationTableSeeder extends Seeder
{
    public function run(): void
    {
        $provinces = json_decode(file_get_contents(database_path('data/provinces.json')), true);
        $cities    = json_decode(file_get_contents(database_path('data/cities.json')), true);

        foreach ($provinces as $province) {
            DB::table('provinces')->insert([
                'id'         => $province['id'],
                'name'       => $province['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        foreach ($cities as $city) {
            DB::table('cities')->insert([
                'id'          => $city['id'],
                'province_id' => $city['province_id'],
                'name'        => $city['type'] . ' ' . $city['name'],
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
