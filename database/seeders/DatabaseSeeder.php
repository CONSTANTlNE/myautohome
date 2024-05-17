<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Client;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */


    public function run(): void
    {
//        User::factory(5)->create();
        Client::factory(1000)->create();
//        $this->call(PermissionSeeder::class);
//        $this->call(RoleSeeder::class);
//        $this->call(UserSeeder::class);
//        $this->call(GeneralSeeder::class);
//
//        Application::factory(100)->create();
    }





}
