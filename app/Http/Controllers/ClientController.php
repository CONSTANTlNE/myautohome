<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use App\Models\PotentialClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{

    public function existingIndex()
    {

        $clients = Client::withCount('applications')->get();
        $cars             = Car::all();

        return view('pages.existingclients', compact('clients','cars'));

    }

    public function potentialIndex()
    {
        $potentialclients = PotentialClient::all();
        $cars             = Car::all();

        return view('pages.potentialclients', compact('potentialclients','cars'));
    }

    public function createPotential(Request $request)
    {
        $validate=Validator::make($request->all(), [
            'pid' => 'nullable|string',
            'name' => 'nullable|string',
            'mobile' => 'required|string',
            'comment' => 'nullable|string',
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();
            return view('htmx.errors')->with('errors', $errors);
        }


        $validated = $validate->validated();

        $client          = new PotentialClient();
        $client->pid     = $validated['pid'];
        $client->name    = $validated['name'];
        $client->mobile  = $validated['mobile'];
        $client->comment = $validated['comment'];
        $client->save();

        return back();
    }

    public function updatePotential(Request $request)
    {

        $validate=Validator::make($request->all(), [
            'pid' => 'nullable|string',
            'name' => 'nullable|string',
            'mobile' => 'required|string',
            'comment' => 'nullable|string',
            'id' => 'required|integer|exists:potential_clients,id',
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();
            return view('htmx.errors')->with('errors', $errors);
        }


        $validated = $validate->validated();

        $client          = PotentialClient::find($validated['id']);
        $client->pid     = $validated['pid'];
        $client->name    = $validated['name'];
        $client->mobile  = $validated['mobile'];
        $client->comment = $validated['comment'];
        $client->save();

        return back();

    }



//  ===========  HTMX  ============


    public function htmxpotentialIndex(Request $request)
    {

        if($request->session()->has('request_counter')) {
            $counter = $request->session()->get('request_counter')+1;
            $request->session()->put('request_counter', $counter);

        } else {
            $counter = 1;
            $request->session()->put('request_counter', $counter);
        }

        $potentialclients = PotentialClient::all();


        return view('htmx.htmxpotentialclients',compact('potentialclients','counter'));
    }

    public function htmxcreatePotential(Request $request)
    {
        if($request->session()->has('request_counter')) {
            $counter = $request->session()->get('request_counter')+1;
            $request->session()->put('request_counter', $counter);

        } else {
            $counter = 1;
            $request->session()->put('request_counter', $counter);
        }


        $validate=Validator::make($request->all(), [
            'pid' => 'nullable|string',
            'name' => 'nullable|string',
            'mobile' => 'required|string',
            'comment' => 'nullable|string',
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();
            return view('htmx.errors')->with('errors', $errors);
        }


        $validated = $validate->validated();

        $client          = new PotentialClient();
        $client->pid     = $validated['pid'];
        $client->name    = $validated['name'];
        $client->mobile  = $validated['mobile'];
        $client->comment = $validated['comment'];
        $client->save();

        $potentialclients = PotentialClient::all();

        return view('htmx.htmxpotentialclients',compact('potentialclients','counter'));
    }


    public function htmxupdatePotential(Request $request)
    {

        if($request->session()->has('request_counter')) {
            $counter = $request->session()->get('request_counter')+1;
            $request->session()->put('request_counter', $counter);

        } else {
            $counter = 1;
            $request->session()->put('request_counter', $counter);
        }


        $validate=Validator::make($request->all(), [
            'pid' => 'nullable|string',
            'name' => 'nullable|string',
            'mobile' => 'required|string',
            'comment' => 'nullable|string',
            'id' => 'required|integer|exists:potential_clients,id',
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();
            return view('htmx.errors')->with('errors', $errors);
        }


        $validated = $validate->validated();

        $client          = PotentialClient::find($validated['id']);
        $client->pid     = $validated['pid'];
        $client->name    = $validated['name'];
        $client->mobile  = $validated['mobile'];
        $client->comment = $validated['comment'];
        $client->save();


        $potentialclients = PotentialClient::all();

      return view('htmx.htmxpotentialclients',compact('potentialclients','counter'));

    }




}
