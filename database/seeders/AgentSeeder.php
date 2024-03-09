<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create new dummy agent
        Agent::create([
            'name' => 'Jhon Doe',
            'email' => 'agent@example.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
