<?php

namespace App\Http\Controllers;

use App\Models\Allowedip;
use Illuminate\Http\Request;

class AllowedipController extends Controller
{
    public function index (){



        return view ('ip-error');
    }



    public function create(){

        $ips = Allowedip::all();

        return view('htmx.htmxips',compact('ips'));
    }


    public function store(Request $request){

        $allowedip = new Allowedip();
        $allowedip->ip=$request->ip;
        $allowedip->name=$request->name;
        $allowedip->save();

    }


    public function destroy(Request $request){
      $ip=AllowedIp::find($request->id);
      $ip->delete();
    }

}
