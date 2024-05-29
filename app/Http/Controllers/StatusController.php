<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    public function  store(Request $request)
    {
        $validate=Validator::make($request->all(), [
            'badge' => 'required|string',
            'name' => 'required|string',
            ]);


        if ($validate->fails()) {
            $errors = $validate->errors();
            return view('htmx.errors')->with('errors', $errors);
        }


        $validated = $validate->validated();

        $status = new Status();
        $status -> color = $validated['badge'];
        $status -> name = $validated['name'];
        $status -> save();

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();

        return view('htmx.htmxother', compact('companies', 'statuses', 'products', 'sources'));
    }


    public function  update(Request $request)
    {




        if($request->has('name')){

            $validate=Validator::make($request->all(), [
                'name' => 'required|string',
            ]);
            $validated = $validate->validated();

            if ($validate->fails()) {
                $errors = $validate->errors();
                return view('htmx.errors')->with('errors', $errors);
            }

            $status = Status::find($request->id);
            $status -> name = $validated['name'];
            $status -> save();

            $companies = Company::all();
            $statuses  = Status::all();
            $products  = Product::all();
            $sources   = Source::all();

            return view('htmx.htmxother', compact('companies', 'statuses', 'products', 'sources'));
        }

        if($request->has('badge')){

            $validate=Validator::make($request->all(), [
                'badge' => 'required|string',
            ]);
            $validated = $validate->validated();

            if ($validate->fails()) {
                $errors = $validate->errors();
                return view('htmx.errors')->with('errors', $errors);
            }
            $status = Status::find($request->id);
            $status -> color = $validated['badge'];
            $status -> save();

            $companies = Company::all();
            $statuses  = Status::all();
            $products  = Product::all();
            $sources   = Source::all();

            return view('htmx.htmxother', compact('companies', 'statuses', 'products', 'sources'));
        }

    }
}
