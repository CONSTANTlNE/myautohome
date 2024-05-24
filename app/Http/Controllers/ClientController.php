<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PotentialClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{

    public function existingIndex()
    {

        $clients = Client::withCount('applications')->get();

        return view('pages.existingclients', compact('clients'));

    }

    public function potentialIndex()
    {
        $potentialclients = PotentialClient::all();

        return view('pages.potentialclients', compact('potentialclients'));
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

    }
}
