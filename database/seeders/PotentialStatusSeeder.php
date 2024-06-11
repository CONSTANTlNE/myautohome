<?php

namespace Database\Seeders;

use App\Models\PotentialStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PotentialStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PotentialStatus::create(['name' => 'ვერ დავუკავშირდი', 'color' => 'badge bg-outline-warning']);
        PotentialStatus::create(['name' => 'მოიფიქრებს', 'color' => 'badge bg-outline-success']);
        PotentialStatus::create(['name' => 'დაინტერესებულია, მოვა ფილიალში', 'color' => 'badge bg-outline-success']);
        PotentialStatus::create(['name' => 'გადაიფიქრა', 'color' => 'badge bg-outline-danger']);
        PotentialStatus::create(['name' => 'შეაფსო განაცხადი', 'color' => 'badge bg-outline-secondary']);
        PotentialStatus::create(['name' => 'დუბლიკატი', 'color' => 'badge bg-outline-danger']);
    }
}
