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
        Company::create(['name' => 'მოგო/დიზი']);
        Company::create(['name' => 'დიზი']);
        Company::create(['name' => 'თიბისი/ტერა']);
        Company::create(['name' => 'მოგო/დიზი/თბს']);
        Company::create(['name' => 'თიბისი ლიზინგი']);
        Company::create(['name' => 'სილქ როუდ ბანკი']);
        Company::create(['name' => 'ტერა']);
        Company::create(['name' => 'მოგო/დიზი/თიბისი']);
        Company::create(['name' => 'მოგო/დიზი/ტერა/თიბისი']);
        Company::create(['name' => 'მოგო/დიზი/ტერა/თიბისი/სილქი']);
        Company::create(['name' => 'ტერა/სილქი']);
        Company::create(['name' => 'მოგო/თბს']);
        Company::create(['name' => 'მოგო/დიზი/ტერა/თბს']);
        Company::create(['name' => 'მოგო/ტერა/სილქი']);
        Company::create(['name' => 'სილქი']);
        Company::create(['name' => 'მოგო/დიზი/ტერა']);
        Company::create(['name' => 'თიბისი/მოგო/ტერა']);
        Company::create(['name' => 'მოგო/ტერა']);



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
        Status::create(['name' => 'არ არის დაინტერესებული','color' => 'badge bg-outline-danger']);

        Source::create(['name' => 'საიტი']);
        Source::create(['name' => 'ოპერატორი']);

    }
}
