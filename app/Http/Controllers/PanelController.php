<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\Company;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
use Illuminate\Http\Request;

class PanelController extends Controller
{

    public function manage(Request $request)
    {
        if ($request->has('type') && $request->type == 'other') {
            return $this->index2();
        }
        return $this->index();
    }

    public function index()
    {

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();
        $cars      = Car::with('models')->get();

        return view('pages.other', compact('companies', 'statuses', 'products', 'sources','cars'));
    }

    public function htmxindex()
    {

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();

        return view('htmx.htmxother', compact('companies', 'statuses', 'products', 'sources'));
    }

    public function index2()
    {

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();

        return view('pages.other', compact('companies', 'statuses', 'products', 'sources'));
    }


    public function addCar(Request $request){

        if(!empty($request->newcar)){
            $newcar=new Car();
            $newcar->make=$request->newcar;
            $newcar->save();

            $newmodel=new CarModel();
            $newmodel->car_id=$newcar->id;
            $newmodel->name=$request->newmodel;
            $newmodel->save();
        }

        if (!empty($request->existingcar)) {
            $newmodel=new CarModel();
            $newmodel->car_id=$request->existingcar;
            $newmodel->name=$request->newmodel2;
            $newmodel->save();
        }

        return back();
    }

}
