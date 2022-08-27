<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'jahin',
            'email' => 'admin@gmail.com',
            'role' => 1,
            'password' => Hash::make('15'),
        ]);
        User::create([
            'name' => 'mahmud',
            'email' => 'user@gmail.com',
            'role' => 2,
            'password' => Hash::make('15'),
        ]);
    }
}
