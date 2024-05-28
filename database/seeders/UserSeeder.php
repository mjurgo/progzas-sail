<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'skrzetuski',
            'email' => 'skrzetuski@example.com',
            'role_id' => 1,
        ]);

        User::factory()->count(10)->create(['role_id' => 3]);
        User::factory()->count(3)->create(['role_id' => 2]);
    }
}
