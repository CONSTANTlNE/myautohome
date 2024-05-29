<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SourceController extends Controller
{
    public function  store(Request $request)
    {
        $validate=Validator::make($request->all(), [
            'name' => 'required|string',

        ]);


        if ($validate->fails()) {
            $errors = $validate->errors();
            return view('htmx.errors')->with('errors', $errors);
        }


        $validated = $validate->validated();
        $source = new Source();
        $source -> name = $validated['name'];
        $source -> save();

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();

        return view('htmx.htmxother', compact('companies', 'statuses', 'products', 'sources'));


    }

    public function  update(Request $request)
    {

        $validate=Validator::make($request->all(), [
            'name' => 'required|string',

        ]);


        if ($validate->fails()) {
            $errors = $validate->errors();
            return view('htmx.errors')->with('errors', $errors);
        }

        $validated = $validate->validated();
        $source = Source::find($request->id);
        $source -> name = $validated['name'];
        $source -> save();

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();

        return view('htmx.htmxother', compact('companies', 'statuses', 'products', 'sources'));


    }
}
