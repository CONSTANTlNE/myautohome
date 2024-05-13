<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();

        return view('pages.other', compact('companies', 'statuses', 'products', 'sources'));
    }

    public function create(Request $request)
    {
        dd($request);
    }


}
