<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //call user factory to create admin user
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'is_admin' => '1',
        ]);
        //call user factory to create common user
        \App\Models\User::factory()->create([
            'name' => 'user',
            'email' => 'user@user.com',
            'is_admin' => '0',
        ]);
    }
}
