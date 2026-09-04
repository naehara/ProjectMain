<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akaun Admin
        User::create([
            'name' => 'System Admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
        ]);

        // Akaun Lecturer
        User::create([
            'name' => 'Dr. Nizam',
            'username' => 'lecturer',
            'email' => 'lecturer@example.com',
            'password' => Hash::make('456'),
            'role' => 'lecturer',
        ]);

        // Akaun Student
        User::create([
            'name' => 'Ahmad Student',
            'username' => 'student',
            'email' => 'student@example.com',
            'password' => Hash::make('789'),
            'role' => 'student',
        ]);
    }
}