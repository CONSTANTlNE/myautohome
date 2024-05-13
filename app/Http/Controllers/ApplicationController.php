<?php

namespace App\Http\Controllers;

use App\Models\Application;

use App\Models\Client;
use App\Models\Comment;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(Request $request){

        $letters = chr(random_int(65, 90)) . chr(random_int(65, 90)) . chr(random_int(65, 90)); // ASCII range for uppercase letters
        $digits = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT); // Ensure three digits with leading zeros if needed

        $client=Client::where('pid',$request->customer_pid)->first();

        if($client===null){
            $client=new Client();
            $client->pid=$request->customer_pid;
            $client->name=$request->customer_name;
            $client->mobile1=$request->customer_mobile;
            $client->save();
        }

        $app=new Application();
        $app->number=$letters .'-'. $digits;
        $app->user_id=auth()->user()->id;
        $app->source_id=$request->source;
        $app->status_id=$request->status;
        $app->product_id=$request->product;
        $app->car_id=$request->car;
        $app->client_id =$client->id;
        $app->car_model_id=$request->model;
        $app->link=$request->link;
        $app->engine=$request->engine;
        $app->year=$request->year;
        $app->save();


        if($request->comment){
            $comment=new Comment();
            $comment->user_id=auth()->user()->id;
            $comment->comment=$request->comment;
            $comment->application_id=$app->id;
            $comment->save();

        }




        $app->companies()->attach($request->company);

        return back();

    }
}
