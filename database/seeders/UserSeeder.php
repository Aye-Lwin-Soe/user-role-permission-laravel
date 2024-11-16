<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'username' => 'Testing Admin',
            'address' => 'Ygn',
            'phone' => '0948484444',
            'gender' => 1,
            'is_active' => 1,
            'role_id' => 1,
        ]);
    }
}
