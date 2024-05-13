<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function  store(Request $request)
    {

        $product = new Product();
        $product -> name = $request -> name;
        $product -> save();
        return back();


    }

    public function  update(Request $request)
    {

        $product = Product::find($request->id);
        $product -> name = $request -> name;
        $product -> save();
        return back();

    }

}
