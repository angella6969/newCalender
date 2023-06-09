<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        user::factory(50)->create();
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@yahoo.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
