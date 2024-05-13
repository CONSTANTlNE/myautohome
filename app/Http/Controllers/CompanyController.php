<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function store(Request $request){

        $company = new Company();
        $company -> name = $request -> name;
        $company -> save();
        return back();

    }



    public function update(Request $request){

        $company = Company::find($request->id);
        $company -> name = $request -> name;
        $company -> save();
        return back();

    }
}
