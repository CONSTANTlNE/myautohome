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




        $user1 = User::create([
            'name' => 'ნინი ბორძიკული',
            'email' => 'n.bordzikuli@myautohome.ge',
            'password' => bcrypt('password'),
        ]);
        $user1->assignRole('operator');

        $user2 = User::create([
            'name' => 'დავით კიკვაძე',
            'email' => 'd.kikvadze@myautohome.ge',
            'password' => bcrypt('password'),
        ]);
        $user2->assignRole('operator');

        $user3 = User::create([
            'name' => 'შალვა გოგოლაძე',
            'email' => 'sh.gogoladze@myautohome.ge',
            'password' => bcrypt('password'),
        ]);
        $user3->assignRole('operator');

        $user4 = User::create([
            'name' => 'ნიკა მაისაშვილი',
            'email' => 'n.maisashvili@myautohome.ge',
            'password' => bcrypt('password'),
        ]);
        $user4->assignRole('operator');

        $user5 = User::create([
            'name' => 'ლანა ლურსმანაშვილი',
            'email' => 'l.lursmanashvili@myautohome.ge',
            'password' => bcrypt('password'),
        ]);
        $user5->assignRole('operator');


        $user6 = User::create([
            'name' => 'ვასიკო ყალიჩავა',
            'email' => 'vaso@myautohome.ge',
            'password' => bcrypt('password'),
        ]);
        $user6->assignRole('operator');

        $user7 = User::create([
            'name' => 'ზურა ქაცარავა',
            'email' => 'z.qatsarava@myautohome.ge',
            'password' => bcrypt('password'),
        ]);
        $user7->assignRole('operator');

        $user8 = User::create([
            'name' => 'ნინი გამისონია',
            'email' => 'n.gamisonia@myautohome.ge',
            'password' => bcrypt('password'),
        ]);
        $user8->assignRole('operator');
    }


}
