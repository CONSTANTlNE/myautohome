<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
//        $users = User::withCount('applications')->get();
        $users = User::withCount('applications')->get();

        return view('pages.users', compact('users'));
    }


    public function store(Request $request){


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->mobile = $request->mobile;
        $user->save();

        return back();

    }


    public function userapps($id){

        $user = User::where('id', $id)
           -> with('applications.status', 'applications.status')
            ->first();

        return view('pages.userapps', compact('user'));
    }



}
