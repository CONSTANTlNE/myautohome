<?php

namespace Database\Seeders;

use App\Models\Allowedip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Allowedip::create(['name' => 'dev','ip' => '127.0.0.1']);
        Allowedip::create(['name' => 'dev2','ip' => '94.240.239.76']);
        Allowedip::create(['name' => 'dev3','ip' => '185.115.6.5']);

    }
}
