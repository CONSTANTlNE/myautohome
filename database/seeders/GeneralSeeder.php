<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Product::create(['name' => 'ლიზინგი']);
        Product::create(['name' => 'ლომბარდი']);
        Product::create(['name' => 'პორტირება']);
        Product::create(['name' => 'განბაჟება']);

        Company::create(['name' => 'ნაღდი ანგარიშსწორება']);
        Company::create(['name' => 'მოგო']);
        Company::create(['name' => 'დიზი']);
        Company::create(['name' => 'ტერა ბანკი']);
        Company::create(['name' => 'თბს ლიზინგი']);
        Company::create(['name' => 'სილქ როუდ ბანკი']);
        Company::create(['name' => 'მოგო/დიზი']);
        Company::create(['name' => 'მოგო/ტერა']);
        Company::create(['name' => 'მოგო/თბს']);
        Company::create(['name' => 'მოგო/სილქ როუდი']);
        Company::create(['name' => 'მოგო/დიზი/ტერა']);
        Company::create(['name' => 'მოგო/დიზი/თბს']);
        Company::create(['name' => 'მოგო/დიზი/ტერა/თბს ']);
        Company::create(['name' => 'მოგო/დიზი/ტერა/თბს/სილქ როუდი']);
        Company::create(['name' => 'ტერა/თბს']);
        Company::create(['name' => 'ტერა/თბს/სილქ როუდი']);

        Status::create(['name' => 'ონლაინი']);
        Status::create(['name' => 'ოპერატორის შექმნილი']);
        Status::create(['name' => 'მუშავდება']);
        Status::create(['name' => 'ვერ დავუკავშირდი']);
        Status::create(['name' => 'მოიფიქრებს']);
        Status::create(['name' => 'დაინტერესებულია, მოვა ფილიალში']);
        Status::create(['name' => 'კლიენტის უარი']);
        Status::create(['name' => 'კომპანიის უარი']);
        Status::create(['name' => 'დუბლიკატი']);
        Status::create(['name' => 'დასრულებული']);


        Source::create(['name' => 'საიტი']);
        Source::create(['name' => 'ოპერატორი']);

    }
}
