<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Client;
use App\Models\Company;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{
    public function index()
    {

        $applications = Application::with('client', 'source', 'status', 'product', 'car.models', 'comments.user', 'user', 'companies')
            ->latest()
            ->limit(5)
            ->get();

//        $applications = Application::with([
//            'client:id,name,mobile1,pid',
//            'source:id,name',
//            'status:id,name',
//            'product:id,name',
//            'car.models',
//            'comments.user:id,name',
//            'user:id,name',
//            'companies:id,name'
//        ])  ->latest()
//            ->limit(5)
//            ->get();

        $companies=Company::all();
        $statuses=Status::all();
        $products=Product::all();
        $sources=Source::all();

//
//        if(Cache::has('cars')) {
//            $cars = Cache::get('cars');
//        }
//
//        else {
//            $cars=Car::with('models')->get();
//            Cache::put('cars', $cars, now()->addMinutes(10));
////            dd('cars');
//        }

        $cars=Car::with('models')->get();
        $models    = CarModel::all();

//
//        if(Cache::has('models')) {
//            $models = Cache::get('models');
//        }
//
//        else {
//            $models    = CarModel::all();
//            Cache::put('models', $models, now()->addMinutes(10));
//        }
//        $carsJson = $cars->toJson();
        $carsJson =$cars->toJson();
        return view('pages.main' ,compact('companies','statuses','products','sources','applications','carsJson','models'));
//        return view('pages.main' ,compact('carsJson','applications'));
    }

    public function index2(Request $request)
    {

        if($request->session()->has('request_counter')) {
            $counter = $request->session()->get('request_counter')+1;
            $request->session()->put('request_counter', $counter);

        } else {
            $counter = 1;
            $request->session()->put('request_counter', $counter);
        }


        $applications = Application::with([
            'client:id,name,mobile1',
            'source:id,name',
            'status:id,name',
            'product:id,name',
            'car:id,make',
            'comments.user:id,name',
            'user:id,name',
            'companies:id,name'
        ])  ->latest()
            ->limit(1)
            ->get();
        $companies=Company::all();
        $statuses=Status::all();
        $products=Product::all();
        $sources=Source::all();
        $cars=Car::with('models')->get();
        $models    = CarModel::all();
        $carsJson = $cars->toJson();
        return view('pages.htmx' ,compact('models','companies','statuses','products','sources','carsJson','applications','counter'));
    }


    public function appsearch(Request $request){


        $applications = Client::where('mobile1', $request->search)
            ->orWhere('pid', $request->search)
            ->orWhere('name', 'like', "%{$request->search}%")
            ->with('applications.status', 'applications.user')
            ->limit(30)
            ->first();
        $searchTerm = $request->search;
//
//        $applications = Client::where(function ($query) use ($searchTerm) {
//            $query->where('mobile1', $searchTerm)
//                ->orWhere('pid', $searchTerm)
//                ->orWhere('name', 'like', "%{$searchTerm}%");
//        })
//            ->with('applications')
//            ->get();

//        dd ($applications);


        return view('pages.appsearch', compact('applications'));
    }



    public function htmxsearch(Request $request){
        $applications = Client::where('mobile1', 'like',"%{$request->search}%")
            ->orWhere('pid', 'like', "%{$request->search}%")
            ->orWhere('name', 'like', "%{$request->search}%")
            ->with('applications.status', 'applications.user')
            ->limit(30)
            ->first();
        return view('pages.htmxsearch', compact('applications'));

    }

    public function clearSearch(Request $request){

        return view('pages.clear');
    }
}
