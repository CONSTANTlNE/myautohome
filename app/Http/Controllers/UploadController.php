<?php

namespace App\Http\Controllers;


use App\Imports\CarsImport;
use App\Models\Application;
use App\Models\Car;
use App\Models\CarModel;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    public function index(){
        $cars = Car::all();
        return view('pages.upload', compact('cars'));
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



    public function dataUpload(Request $request){

        $array = Excel::toArray(new CarsImport(),  $request->file('data'));



        foreach ($array[0] as $key => $value){

            $client=new Client();
            $client->name = $value['klientis_sakheli_gvari'];
            $client->pid = $value['piradi_nomeri'];
            $client->mobile1 = $value['mobiluri'];
            $client->save();

            $app=new Application();
            $app->user_id = $value['operaotri'];
            $app->client_id = $client->id;
            $app->source_id=$value['tsyaro'];
            $app->status_id=$value['statusi'];
            $app->product_id=$value['produqti'];

            $app->save();

            $app->companies()->attach($value['kompania']);

        }
        return back();
    }
}
