<?php

namespace App\Http\Controllers;


use App\Models\Car;
use App\Models\Source;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
//        $users = User::withCount('applications')->get();
        $users = User::with('roles')->withCount('applications')->get();
        $cars = Car::all();

        return view('pages.users', compact('users','cars' ));
    }


    public function store(Request $request){

        $validate=Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|string',
            'mobile' => 'nullable|string',
            'password' => 'required|string|min:8',

        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();
            return view('htmx.errors')->with('errors', $errors);
        }


        $validated = $validate->validated();


        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);
        $user->mobile = $validated['mobile'];
        $user->save();

        return back();

    }


    public function userapps($id){

        $user = User::where('id', $id)
           -> with('applications.status', 'applications.status')
            ->first();



        return view('pages.userapps', compact('user', ));
    }


    public function changePassword(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $user->password = bcrypt($request->password);
        $user->save();

    }


    public function changeUserPassword(Request $request)
    {
        $user = User::where('id', $request->userid)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        return json_decode('password changed');

}
}
