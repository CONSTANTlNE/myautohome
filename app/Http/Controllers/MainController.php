<?php

namespace App\Http\Controllers;

use App\Models\Allowedip;
use App\Models\Application;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Client;
use App\Models\Company;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
            'status:id,name,color',
            'product:id,name',
//            'car:id,make',
            'comments.user:id,name',
            'user:id,name',
//            'companies:id,name'
        ])  ->orderBy('created_at', 'desc')
            ->latest()
            ->limit(1000)
            ->get();

        $companies=Company::all();
        $statuses=Status::all();
        $products=Product::all();
        $sources=Source::all();
//        $cars=Car::with('models')->get();
        $cars=Car::all();
        $ips=Allowedip::all();
//        $carsJson =$cars->toJson();
        return view('pages.main' ,compact('companies','statuses','products','sources','applications','cars','ips'));

    }


    public function appsearch(Request $request){


        $applications = Client::where('mobile1', $request->search)
            ->orWhere('pid', $request->search)
            ->orWhere('name', 'like', "%{$request->search}%")
            ->with('applications.status', 'applications.user')

            ->first();
//        $searchTerm = $request->search;
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

    public function dateRange(Request $request)
    {

        $range = $request->input('range');


        list($startDateString, $endDateString) = explode(' to ', $range);

        $startDate = Carbon::createFromFormat('Y-m-d', $startDateString);
        $endDate   = Carbon::createFromFormat('Y-m-d', $endDateString);

        $applications = Application::with('client', 'source', 'status', 'product', 'car.models', 'comments.user', 'user', 'companies')
            ->whereBetween('created_at', [$startDate,  $endDate])
            ->latest()
            ->limit(500)
            ->get();
        $companies=Company::all();
        $statuses=Status::all();
        $products=Product::all();
        $sources=Source::all();
        $cars=Car::all();
        $ips=Allowedip::all();

        return view('pages.main',compact('companies','statuses','products','sources','applications','cars','ips'));

    }



//  =================  HTMX  =======================


    public function htmxdateRange(Request $request)
    {

        if($request->session()->has('request_counter')) {
            $counter = $request->session()->get('request_counter')+1;
            $request->session()->put('request_counter', $counter);
        } else {
            $counter = 1;
            $request->session()->put('request_counter', $counter);
        }

        $range = $request->input('range');


        list($startDateString, $endDateString) = explode(' to ', $range);

        $startDate = Carbon::createFromFormat('Y-m-d', $startDateString);
        $endDate   = Carbon::createFromFormat('Y-m-d', $endDateString);

        $applications = Application::with('client', 'source', 'status', 'product', 'car.models', 'comments.user', 'user', 'companies')
            ->whereBetween('created_at', [$startDate,  $endDate])
            ->latest()
            ->get();
        $companies=Company::all();
        $statuses=Status::all();
        $products=Product::all();
        $sources=Source::all();
        $cars=Car::all();
        $ips=Allowedip::all();

        return view('htmx.htmx',compact('companies','statuses','products','sources','applications','cars','ips','counter'));

    }



    public function index2(Request $request)
    {

        $applications = Application::with([
            'client:id,name,mobile1,pid',
            'source:id,name',
            'status',
            'product:id,name',
//            'car:id,make',
            'comments.user:id,name',
            'user:id,name',

        ])  ->orderBy('created_at', 'desc')
            ->latest()
            ->limit(100)
            ->get();

//        $companies=Company::all();
//        $statuses=Status::all();
//        $products=Product::all();
//        $sources=Source::all();
//
//        $cars=Car::all();


//        $carsJson =$cars->toJson();
//        return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars','counter'));
        return view('htmx.htmx' ,compact('applications',));
    }


    public function htmxsearch(Request $request){
        $applications = Client::where('mobile1', 'like',"%{$request->search}%")
            ->orWhere('pid', 'like', "%{$request->search}%")
            ->orWhere('name', 'like', "%{$request->search}%")
            ->with('applications.status', 'applications.user')
            ->first();
        return view('htmx.htmxsearch', compact('applications'));
    }



    public function clearSearch(Request $request){

        return view('htmx.clear');
    }

    public function carsearch(Request $request){

        $models=CarModel::where('car_id',$request->car)
            ->orderBy('name', 'asc')
            ->get();

        return view('htmx.carmodels',compact('models',));
    }

}
