<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Car;
use App\Models\Company;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {

        $applications=Application::with('client','source','status','product','car.models','comments.user','user','companies')->get();
//        $applications = Application::with([
//            'client:id,name',
//            'source:id,name',
//            'status:id,name',
//            'product:id,name',
//            'car:id,make',
//            'comments.user:id,name',
//            'user:id,name',
//            'companies:id,name'
//        ])->get();

        $companies=Company::all();
        $statuses=Status::all();
        $products=Product::all();
        $sources=Source::all();
        $cars=Car::with('models')->get();
//        dd($cars);
        $carsJson = $cars->toJson();
        return view('pages.main' ,compact('companies','statuses','products','sources','carsJson','applications'));
//        return view('pages.main' ,compact('carsJson','applications'));
    }

//    public function index2(Request $request)
//    {
//
//        if($request->session()->has('request_counter')) {
//            $counter = $request->session()->get('request_counter')+5;
//            $request->session()->put('request_counter', $counter);
//
//        }else {
//            $counter = 1;
//            $request->session()->put('request_counter', $counter);
//
//        }
//
//
//        $applications=Application::with('client','source','status','product','car.models','comments.user','user','companies')->get();
//        $companies=Company::all();
//        $statuses=Status::all();
//        $products=Product::all();
//        $sources=Source::all();
//        $cars=Car::with('models')->get();
////        dd($cars);
//        $carsJson = $cars->toJson();
//        return view('pages.htmx' ,compact('companies','statuses','products','sources','carsJson','applications','counter'));
//    }


}
