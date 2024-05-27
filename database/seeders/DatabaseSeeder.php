<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */


    public function run(): void
    {
//        $this->call(PermissionSeeder::class);
//        $this->call(RoleSeeder::class);
//        User::factory(10)->create();
//        Client::factory(1000)->create();
//
//        $this->call(UserSeeder::class);
//        $this->call(GeneralSeeder::class);

        Application::factory(2000)->create();
    }





}
