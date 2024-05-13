<?php

namespace App\Http\Controllers;


use App\Imports\CarsImport;
use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    public function index(){
        return view('pages.upload');
    }


    public function carUpload(Request $request){

//        dd($request->file());
        $array = Excel::toArray(new CarsImport(),  $request->file('cars'));


        foreach ($array[0] as $key => $value) {
             $car=Car::where('make', $value['make'])->first();

            if(!$car){
                $car = new Car();
                $car->make = $value['make'];
                $car->save();
            }
        }

        foreach ($array[0] as $key => $value) {
            $car=Car::where('make', $value['make'])->first();
            $model=CarModel::where('name', $value['model'])->first();

            if(!$model){
                $model = new CarModel();
                $model->name = $value['model'];
                $model->car_id = $car->id;
                $model->save();
            }
        }


         return back();
    }
}
