<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Notification;
use App\Models\PotentialClient;
use App\Models\PotentialStatus;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{

    public function existingIndex()
    {

        $clients = Client::withCount('applications')->get();
        $cars    = Car::all();

        return view('pages.existingclients', compact('clients', 'cars'));

    }

    public function potentialIndex()
    {

        $potentialclients = PotentialClient::with('user')
            ->orderBy('id', 'desc')
            ->limit(300)
            ->get();

        $authuser = auth()->user();


        if (auth()->user()->hasRole('admin')) {
            $cars = Car::all();

            return view('pages.potentialclients', compact('potentialclients', 'cars', 'authuser'));

        } else {
            return view('pages.potentialclients', compact('potentialclients', 'authuser'));

        }
    }

    public function createPotential(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'pid'     => 'nullable|string',
            'name'    => 'nullable|string',
            'mobile'  => 'required|string',
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
        $client->user_id = auth()->user()->id;
        $client->comment = $validated['comment'];
        $client->save();

        return back();
    }

    public function updatePotential(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'pid'     => 'nullable|string',
            'name'    => 'nullable|string',
            'mobile'  => 'required|string',
            'comment' => 'nullable|string',
            'id'      => 'required|integer|exists:potential_clients,id',
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();

            return view('htmx.errors')->with('errors', $errors);
        }


        $validated = $validate->validated();

        $client          = PotentialClient::find($validated['id']);
        $client->pid     = $validated['pid'];
        $client->name    = $validated['name'];
        $client->user_id = auth()->user()->id;
        $client->mobile  = $validated['mobile'];
        $client->comment = $validated['comment'];
        $client->save();

        return back();

    }


//  ============  HTMX  =============


    public function htmxpotentialIndex(Request $request)
    {

        $potentialclients = PotentialClient::with('user', 'comments.user', 'status')
            ->orderBy('id', 'desc')
            ->limit(300)
            ->get();


        $authuser = auth()->user();
        $potentialstatuses=PotentialStatus::all();


        return view('htmx.htmxpotentialclients', compact('potentialclients', 'authuser','potentialstatuses'));
    }

    public function htmxcreatePotential(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'pid'     => 'nullable|string',
            'name'    => 'nullable|string',
            'mobile'  => 'required|string',
            'comment' => 'nullable|string',
            'status'=>'nullable|integer|exists:potential_statuses,id'
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();


//            return response()->view('htmx.errors',compact('errors'))->setStatusCode(500);
            return view('htmx.errors',compact('errors'));
        }


        $validated = $validate->validated();

        $client          = new PotentialClient();
        $client->pid     = $validated['pid'];
        $client->name    = $validated['name'];
        $client->user_id = auth()->user()->id;
        $client->mobile  = $validated['mobile'];
        $client->comment = $validated['comment'];
        $client->status_id=$validated['status'];
        $client->save();

        $potentialclients = PotentialClient::with('user', 'comments.user', 'status')
            ->orderBy('id', 'desc')
            ->limit(300)
            ->get();

        $authuser = auth()->user();
        $potentialstatuses=PotentialStatus::all();

        return view('htmx.htmxpotentialclients', compact('potentialclients', 'authuser','potentialstatuses'));

    }

    public function htmxupdatePotential(Request $request)
    {
        $authuser = auth()->user();

        $client = PotentialClient::find($request->id);

        if ($client->user_id != $authuser->id && $authuser->hasAnyRole('operator|callcenter')) {
            $validate = Validator::make($request->all(), [
                'newcomment'   => 'nullable|array',
                'newcomment.*' => 'string',
                'status'=>'nullable|integer|exists:potential_statuses,id'
            ]);



        } else {
            $validate = Validator::make($request->all(), [
                'pid'          => 'nullable|string|max:11|min:11',
                'name'         => 'nullable|string|max:191',
                'mobile'       => 'sometimes|string',
                'comment'      => 'nullable|string',
                'newcomment'   => 'nullable|array',
                'newcomment.*' => 'string',
                'id'           => 'required|integer|exists:potential_clients,id',
                'status'=>'nullable|integer|exists:potential_statuses,id'
            ]);

        }


        if ($validate->fails()) {
            $errors = $validate->errors();

            return view('htmx.errors')->with('errors', $errors);
        }


        $validated = $validate->validated();

        if ($client->user_id == $authuser->id || $authuser->hasAnyRole('admin|developer')) {
            $client->pid     = $validated['pid'];
            $client->name    = $validated['name'];
            $client->mobile  = $validated['mobile'];
            $client->status_id=$validated['status'];
            if( $request->has('comment') ){
                $client->comment = $validated['comment'];
            }

        } else{
            $client->status_id=$validated['status'];
        }


        if ($request->has('newcomment')) {

            Log::channel('changes')->info('პოტენციურ კლიენტს : '.$client->mobile. ' დაემატა კომენტარი: ' . ' მომხმარებელი: '.auth()->user()->name);

            foreach ($validated['newcomment'] as $comment) {
                $newcomment                     = new Comment();
                $newcomment->comment            = trim($comment);
                $newcomment->potentialclient_id = $client->id;
                $newcomment->application_id     = null;
                $newcomment->user_id            = $authuser->id;
                $newcomment->save();
            }
        }

        $client->save();

        $potentialclients = PotentialClient::with('user', 'comments.user', 'status')
            ->orderBy('id', 'desc')
            ->limit(300)
            ->get();
        $potentialstatuses=PotentialStatus::all();


        return view('htmx.htmxpotentialclients', compact('potentialclients', 'authuser','potentialstatuses'));

    }

    public function htmxclientdaterange(Request $request)
    {

        $range    = $request->input('range');
        $authuser = auth()->user();


        list($startDateString, $endDateString) = explode(' to ', $range);

        $startDate = Carbon::createFromFormat('Y-m-d', $startDateString)->startOfDay();
        $endDate   = Carbon::createFromFormat('Y-m-d', $endDateString)->endOfDay();

        $potentialclients = PotentialClient::with('user', 'comments.user', 'status')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        $potentialstatuses=PotentialStatus::all();


        return view('htmx.htmxpotentialclients', compact('potentialclients', 'authuser','potentialstatuses'));

    }

    public function htmxsearchpotential(Request $request)
    {
        $potentials = PotentialClient::where('mobile', 'like', "%{$request->search}%")
            ->orWhere('pid', 'like', "%{$request->search}%")
            ->orWhere('name', 'like', "%{$request->search}%")
            ->with('user', 'comments.user', 'status')
            ->get();
        $authuser   = auth()->user();

        $potentialstatuses=PotentialStatus::all();
        return view('htmx.htmxpotentialsearch', compact('potentials', 'authuser','potentialstatuses'));
    }

    public function editsearchpotential($id)
    {

        $potential = PotentialClient::where('id', $id)
            ->with('user', 'comments.user', 'status')
            ->first();
        $authuser  = auth()->user();


        $potentialstatuses=PotentialStatus::all();
        return view('htmx.editsearchpotential', compact('potential', 'authuser','potentialstatuses'));

    }

public function htmxdestroypotential(Request $reqyest){

    $potential=PotentialClient::find($reqyest->id);

    Log::channel('changes')->info('წაიშალა პოტენციური კლიენტი No: '.$potential->id. ' პირადი ნომერი: '.$potential->pid. ' მობილური: '.$potential->mobile . ' მომხმარებელი: '.auth()->user()->name);


    $potential->delete();



    $potentialclients = PotentialClient::with('user', 'comments.user', 'status')
        ->orderBy('id', 'desc')
        ->limit(300)
        ->get();

    $authuser = auth()->user();
    $potentialstatuses=PotentialStatus::all();


    return view('htmx.htmxpotentialclients', compact('potentialclients', 'authuser','potentialstatuses'));

}
}