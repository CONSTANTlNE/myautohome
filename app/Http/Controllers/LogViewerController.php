<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogViewerController extends Controller
{
    public function show(Request $request)
    {
        $query = $request->query('OMM-459');

        // Process the file and query as needed
        return view('log-viewer', [ 'query' => $query]);
    }
}
