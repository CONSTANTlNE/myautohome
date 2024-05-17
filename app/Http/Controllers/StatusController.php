<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function  store(Request $request)
    {

        $status = new Status();
        $status -> color = $request -> badge;
        $status -> name = $request -> name;
        $status -> save();
        return back();
    }


    public function  update(Request $request)
    {
        $status = Status::find($request->id);
        $status -> name = $request -> name;
        $status -> save();
        return back();
    }
}
