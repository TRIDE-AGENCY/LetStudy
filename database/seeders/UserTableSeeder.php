<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'      => 'Administrator',
            'role'      => 'Admin',
            'gender'    => 'L',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('password'),
        ]);
    }
}
