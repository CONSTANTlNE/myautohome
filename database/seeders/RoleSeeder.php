<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Role::create(['name' => 'admin']);
       $operator = Role::create(['name' => 'operator']);
        $operator->givePermissionTo(['Own_Data']);

    }
}
