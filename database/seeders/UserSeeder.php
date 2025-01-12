<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan user pertama untuk testing atau admin
        User::create(['name' => 'iqbal',
            'email' => 'iqbal@example.com',
            'password' => Hash::make('123456'), // Jangan lupa untuk meng-hash password
        ]);


    }
}
