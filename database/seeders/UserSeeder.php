<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');
        $developer = User::create([
            'name' => 'developer',
            'email' => 'developer@test.com',
            'password' => bcrypt('password'),
        ]);
        $developer->assignRole('developer');
        $operator = User::create([
            'name' => 'Operator',
            'email' => 'operator@test.com',
            'password' => bcrypt('password'),
        ]);
        $operator->assignRole('operator');
    }
}
