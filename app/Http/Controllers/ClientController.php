<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function existingIndex()
    {

        $clients = Client::withCount('applications')->get();

        return view('pages.existingclients', compact('clients'));

    }

    public function potentialIndex()
    {

        return view('pages.potentialclients');
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request)
    {

    }
}
