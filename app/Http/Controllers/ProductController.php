<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PotentialStatus;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();

            return view('htmx.errors')->with('errors', $errors);
        }

        $validated = $validate->validated();

        $product       = new Product();
        $product->name = $validated['name'];
        $product->save();

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();
        $potentialstatus  = PotentialStatus::all();

        return view('htmx.htmxother', compact('companies', 'statuses', 'products', 'sources', 'potentialstatus'));

    }

    public function update(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();

            return view('htmx.errors')->with('errors', $errors);
        }
        $validated = $validate->validated();
        $product       = Product::find($request->id);
        $product->name = $validated['name'];
        $product->save();

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();
        $potentialstatus  = PotentialStatus::all();

        return view('htmx.htmxother', compact('companies', 'statuses', 'products', 'sources', 'potentialstatus'));


    }

}
