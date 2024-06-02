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
use Illuminate\Foundation\Auth\User;
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
            ->limit(300)
            ->get();

        $companies=Company::all();
        $statuses=Status::all();
        $products=Product::all();
        $sources=Source::all();
        $cars=Car::all();
        $authuser=auth()->user();
        $users=User::pluck('name','id');

//        $carsJson =$cars->toJson();
        return view('pages.main' ,compact('companies','statuses','products','sources','applications','cars','authuser','users'));

    }


    public function appsearch(Request $request){

        $authuser=auth()->user();
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


        return view('pages.appsearch', compact('applications','authuser'));
    }

    public function dateRange(Request $request)
    {

        $range = $request->input('range');
        $authuser=auth()->user();

        list($startDateString, $endDateString) = explode(' to ', $range);

        $startDate = Carbon::createFromFormat('Y-m-d', $startDateString);
        $endDate   = Carbon::createFromFormat('Y-m-d', $endDateString);

        $applications = Application::with('client', 'source', 'status', 'product', 'car.models', 'comments.user', 'user', 'companies',)
            ->whereBetween('created_at', [$startDate,  $endDate])
            ->latest()

            ->get();
        $companies=Company::all();
        $statuses=Status::all();
        $products=Product::all();
        $sources=Source::all();
        $cars=Car::all();


        return view('pages.main',compact('companies','statuses','products','sources','applications','cars','authuser'));

    }



//  =================  HTMX  =======================


    public function htmxdateRange(Request $request)
    {
        $authuser=auth()->user();

        if($request->input('range') == null){
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
                ->limit(300)
                ->get();

            return view('htmx.htmx' ,compact('applications','authuser'));


        }
        $range = $request->input('range');


        list($startDateString, $endDateString) = explode(' to ', $range);

        $startDate = Carbon::createFromFormat('Y-m-d', $startDateString)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $endDateString)->endOfDay();

        $applications = Application::with('client', 'source', 'status', 'product', 'car.models', 'comments.user', 'user', 'companies')
            ->whereBetween('created_at', [$startDate,  $endDate])
            ->latest()
            ->get();
//        $companies=Company::all();
//        $statuses=Status::all();
//        $products=Product::all();
//        $sources=Source::all();
//        $cars=Car::all();
//        $ips=Allowedip::all();



        return view('htmx.htmx' ,compact('applications','authuser'));

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
            ->limit(300)
            ->get();
        $authuser=auth()->user();

//        $companies=Company::all();
//        $statuses=Status::all();
//        $products=Product::all();
//        $sources=Source::all();
//
//        $cars=Car::all();


//        $carsJson =$cars->toJson();
//        return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars','counter'));
        return view('htmx.htmx' ,compact('applications','authuser'));
    }

    public function htmxsearch(Request $request){

        if(empty($request->search)){
            return view('htmx.clear');
        }


        $clients = Client::where('mobile1', 'like',"%{$request->search}%")
            ->orWhere('pid', 'like', "%{$request->search}%")
            ->orWhere('name', 'like', "%{$request->search}%")
            ->with('applications.status', 'applications.user')
            ->get();



        return view('htmx.htmxsearch', compact('clients',));
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
