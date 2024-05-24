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

class MainController extends Controller
{
    public function index()
    {

//        $applications = Application::with('client', 'source', 'status', 'product', 'car.models', 'comments.user', 'user', 'companies')
//            ->latest()
//            ->limit(500)
//            ->get();

        $applications = Application::with([
            'client:id,name,mobile1,pid',
            'source:id,name',
            'status',
            'product:id,name',
            'car:id,make',
            'comments.user:id,name',
            'user:id,name',
//            'companies:id,name'
        ])  ->latest()
            ->limit(100)
            ->get();

        $companies=Company::all();
        $statuses=Status::all();
        $products=Product::all();
        $sources=Source::all();
//        $cars=Car::with('models')->get();
        $cars=Car::all();

//        $carsJson =$cars->toJson();
        return view('pages.main' ,compact('companies','statuses','products','sources','applications','cars'));

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



//  =================  HTMX  =======================




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
            'client:id,name,mobile1,pid',
            'source:id,name',
            'status',
            'product:id,name',
            'car:id,make',
            'comments.user:id,name',
            'user:id,name',
            'companies:id,name'
        ])  ->orderBy('created_at', 'desc')
            ->latest()
            ->limit(300)
            ->get();

        $companies=Company::all();
        $statuses=Status::all();
        $products=Product::all();
        $sources=Source::all();
//        $cars=Car::with('models')->get();
        $cars=Car::all();

//        $carsJson =$cars->toJson();
        return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars','counter'));
    }


    public function htmxsearch(Request $request){
        $applications = Client::where('mobile1', 'like',"%{$request->search}%")
            ->orWhere('pid', 'like', "%{$request->search}%")
            ->orWhere('name', 'like', "%{$request->search}%")
            ->with('applications.status', 'applications.user')
            ->limit(30)
            ->first();
        return view('htmx.htmxsearch', compact('applications'));

    }



    public function clearSearch(Request $request){

        return view('htmx.clear');
    }

    public function carsearch(Request $request){

        if($request->session()->has('request_counter2')) {
            $counter2 = $request->session()->get('request_counter2')+1;
            $request->session()->put('request_counter2', $counter2);

        } else {
            $counter2 = 1;
            $request->session()->put('request_counter2', $counter2);
        }

        $models=CarModel::where('car_id',$request->car)->get();

        return view('htmx.carmodels',compact('models','counter2'));
    }




}
