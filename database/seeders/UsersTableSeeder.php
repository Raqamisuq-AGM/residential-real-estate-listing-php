<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create new dummy user
        User::create([
            'name' => 'Jhon Doe',
            'email' => 'user@example.com',
            'password' => Hash::make('12345678'),
            'otp' => '',
            'status' => 'active',
            'type' => 'user',
        ]);
    }
}