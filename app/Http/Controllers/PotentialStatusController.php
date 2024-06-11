<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PotentialStatus;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PotentialStatusController extends Controller
{
    public function createpotentialstatus(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'badge' => 'required|string',
            'name'  => 'required|string',
        ]);


        if ($validate->fails()) {
            $errors = $validate->errors();

            return view('htmx.errors')->with('errors', $errors);
        }


        $validated = $validate->validated();

        $status        = new PotentialStatus();
        $status->color = $validated['badge'];
        $status->name  = $validated['name'];
        $status->save();

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();
        $potentialstatus  = PotentialStatus::all();

        return view('htmx.htmxother', compact('companies', 'statuses', 'products', 'sources', 'potentialstatus'));
    }


    public function updatepotentialstatus(Request $request)
    {

// return $request->all();
        if ($request->has('name')) {

            $validate  = Validator::make($request->all(), [
                'name' => 'required|string',
            ]);

            $validated = $validate->validated();

            if ($validate->fails()) {
                $errors = $validate->errors();

                return view('htmx.errors')->with('errors', $errors);
            }

            $status        = PotentialStatus::find($request->id);
            $status->name = $validated['name'];
            $status->save();

            $companies = Company::all();
            $statuses  = Status::all();
            $products  = Product::all();
            $sources   = Source::all();
            $potentialstatus  = PotentialStatus::all();

            return view('htmx.htmxother', compact('companies', 'statuses', 'products', 'sources', 'potentialstatus'));
        }

        if ($request->has('badge')) {

            $validate  = Validator::make($request->all(), [
                'badge' => 'required|string',
            ]);
            $validated = $validate->validated();

            if ($validate->fails()) {
                $errors = $validate->errors();

                return view('htmx.errors')->with('errors', $errors);
            }
            $status        = PotentialStatus::find($request->id);
            $status->color = $validated['badge'];
            $status->save();

            $companies = Company::all();
            $statuses  = Status::all();
            $products  = Product::all();
            $sources   = Source::all();
            $potentialstatus  = PotentialStatus::all();

            return view('htmx.htmxother', compact('companies', 'statuses', 'products', 'sources', 'potentialstatus'));
        }

    }


}

