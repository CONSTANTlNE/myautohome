<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function  store(Request $request)
    {

        $source = new Source();
        $source -> name = $request -> name;
        $source -> save();
        return back();


    }

    public function  update(Request $request)
    {

        $source = Source::find($request->id);
        $source -> name = $request -> name;
        $source -> save();
        return back();

    }
}
