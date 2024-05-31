<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use App\Models\PotentialClient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

        $potentialclients = PotentialClient::with('user')
            ->orderBy('id','desc')
            ->limit(500)
            ->get();

        $authuser=auth()->user();


        if(auth()->user()->hasRole('admin')) {
            $cars             = Car::all();

            return view('pages.potentialclients', compact('potentialclients','cars','authuser'));

        } else{
            return view('pages.potentialclients', compact('potentialclients','authuser'));

        }
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
        $client->user_id     = auth()->user()->id;
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
        $client->user_id     = auth()->user()->id;
        $client->mobile  = $validated['mobile'];
        $client->comment = $validated['comment'];
        $client->save();

        return back();

    }



//  ===========  HTMX  ============


    public function htmxpotentialIndex(Request $request)
    {

        $potentialclients = PotentialClient::with('user')
            ->orderBy('id','desc')
            ->limit(500)
            ->get();


        $authuser=auth()->user();


        return view('htmx.htmxpotentialclients',compact('potentialclients','authuser'));
    }

    public function htmxcreatePotential(Request $request)
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
        $client->user_id     = auth()->user()->id;
        $client->mobile  = $validated['mobile'];
        $client->comment = $validated['comment'];
        $client->save();

        $potentialclients = PotentialClient::with('user')
           ->orderBy('id','desc')
            ->limit(500)
            ->get();

        $authuser=auth()->user();


            return view('pages.potentialclients', compact('potentialclients','authuser'));

    }


    public function htmxupdatePotential(Request $request)
    {



        $validate=Validator::make($request->all(), [
            'pid' => 'nullable|string',
            'name' => 'nullable|string',
            'mobile' => 'sometimes|string',
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


        $potentialclients = PotentialClient::with('user')
            ->orderBy('id','desc')
            ->limit(500)
            ->get();

        $authuser=auth()->user();


        return view('htmx.htmxpotentialclients',compact('potentialclients','authuser'));

    }


    public function htmxclientdaterange(Request $request)
    {

        $range = $request->input('range');
        $authuser=auth()->user();


        list($startDateString, $endDateString) = explode(' to ', $range);

        $startDate = Carbon::createFromFormat('Y-m-d', $startDateString)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $endDateString)->endOfDay();

        $potentialclients = PotentialClient::with('user')
           ->whereBetween('created_at', [$startDate,  $endDate])
            ->latest()
            ->get();


        return view('htmx.htmxpotentialclients',compact('potentialclients','authuser'));

    }

    public function htmxsearchpotential(Request $request){
        $potentials = PotentialClient::where('mobile', 'like',"%{$request->search}%")
            ->orWhere('pid', 'like', "%{$request->search}%")
            ->orWhere('name', 'like', "%{$request->search}%")
            ->with('user')
            ->get();
        $authuser=auth()->user();

        return view('htmx.htmxpotentialsearch', compact('potentials','authuser'));
    }




}
