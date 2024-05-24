<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
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

        Status::create(['name' => 'ონლაინი', 'color' => 'badge bg-outline-warning2']);
        Status::create(['name' => 'ოპერატორის შექმნილი','color' => 'badge bg-outline-warning2']);
        Status::create(['name' => 'მუშავდება', 'color' => 'badge bg-outline-primary']);
        Status::create(['name' => 'ვერ დავუკავშირდი', 'color' => 'badge bg-outline-warning']);
        Status::create(['name' => 'მოიფიქრებს','color' => 'badge bg-outline-success2']);
        Status::create(['name' => 'დაინტერესებულია, მოვა ფილიალში','color' => 'badge bg-outline-success2']);
        Status::create(['name' => 'კლიენტის უარი', 'color' => 'badge bg-outline-danger']);
        Status::create(['name' => 'კომპანიის უარი','color' => 'badge bg-outline-danger']);
        Status::create(['name' => 'დუბლიკატი','color' => 'badge bg-outline-danger']);
        Status::create(['name' => 'დასრულებული','color' => 'badge bg-outline-success']);


        Source::create(['name' => 'საიტი']);
        Source::create(['name' => 'ოპერატორი']);

    }
}
