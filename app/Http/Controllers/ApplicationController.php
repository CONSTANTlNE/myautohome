<?php

namespace App\Http\Controllers;

use App\Models\Application;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\Client;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {

        $letters = chr(random_int(65, 90)).chr(random_int(65, 90)).chr(random_int(65,
                90)); // ASCII range for uppercase letters
        $digits  = str_pad(random_int(0, 999), 3, '0',
            STR_PAD_LEFT); // Ensure three digits with leading zeros if needed

        $client = Client::where('pid', $request->customer_pid)->first();

        if ($client === null) {
            $client          = new Client();
            $client->pid     = $request->customer_pid;
            $client->name    = $request->customer_name;
            $client->mobile1 = $request->customer_mobile;
            $client->save();
        }

        $app               = new Application();
        $app->number       = $letters.'-'.$digits;
        $app->user_id      = auth()->user()->id;
        $app->source_id    = $request->source;
        $app->status_id    = $request->status;
        $app->product_id   = $request->product;
        $app->car_id       = $request->car;
        $app->client_id    = $client->id;
        $app->car_model_id = $request->model;
        $app->link         = $request->link;
        $app->engine       = $request->engine;
        $app->year         = $request->year;
        $app->save();


        if ($request->comment) {
            $comment                 = new Comment();
            $comment->user_id        = auth()->user()->id;
            $comment->comment        = $request->comment;
            $comment->application_id = $app->id;
            $comment->save();

        }


        $app->companies()->attach($request->company);

        return back();

    }

    public function edit($id)
    {

        $application = Application::with('client', 'source', 'status', 'product', 'car.models', 'comments.user', 'user',
            'companies')
            ->find($id);

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();
        $cars      = Car::with('models')->get();
//        $models    = CarModel::all();
//        dd($cars);
        $carsJson = $cars->toJson();

        return view('pages.editapp',
            compact('application', 'companies', 'statuses', 'products', 'sources', 'carsJson', 'models'));

    }

    public function update(Request $request)
    {

        $app = Application::with('client', 'source', 'status', 'product', 'car.models', 'comments.user', 'user',
            'companies')
            ->find($request->id);

        $allcompanies = Company::all();

        if ($app->status->id != $request->status) {

            echo 'status changed';
        }

        if ($app->client->pid !== $request->customer_pid) {
            echo 'pid changed';

        }
        if ($app->client->name !== $request->customer_name) {
            echo 'customer name changed';

        }

        if ($app->client->mobile1 !== $request->customer_mobile) {
            echo 'customer mobile changed';

        }

        if ($app->source->id != $request->source) {

            echo 'source changed';
        }

        if ($app->product->id != $request->product) {

            echo 'product changed';
        }


        if ($app->link !== $request->link) {

            echo 'link changed';

        }


        if ($app->car_id != $request->car) {
            echo 'car changed';
        }


        if ($app->car_model_id != $request->model) {
            echo 'car model changed';

        }

        if ($app->year != $request->year) {
            echo 'car year changed';
        }

        if ($app->engine != $request->engine) {
            echo 'car engine changed';
        }


        //  Attach new or change company
        foreach ($request['company'] as $company) {
            if (!in_array($company, $app->companies->pluck('id')->toArray())) {
                Log::channel('changes')->info('განაცხადში No: '.$app->number.'  ჩაემატა კომპანია: '.$allcompanies->where('id',
                        $company)->first()->name.'-- ოპერატორი '.auth()->user()->name);
                $app->companies()->attach($company);
            }
        }

        //  Detach company if removed
        foreach ($app->companies as $company) {
            if (!in_array($company->id, $request['company'])) {
                Log::channel('changes')->info('განაცხადში No: '.$app->number.'  წაიშალა კომპანია: '.$allcompanies->where('id',
                        $company->id)->first()->name.'-- ოპერატორი '.auth()->user()->name);
                $app->companies()->detach($company->id);
            }
        }


          $commentids=$request->commentids;
          $comments=$request->oldcomment;
          $appcomments=$app->comments;

          // update existing comment
          foreach ($commentids as $index => $commentid) {
              // if comment changed
              $comment=$appcomments->where('id',$commentid)->first();
              if($comment->comment!=$comments[$index]){
                  $comment->comment=$comments[$index];
                  $comment->user_id=auth()->user()->id;
                  $comment->save();
              }
          }

          foreach ($request->newcomment as $newcomment){
              $comment=new Comment();
              $comment->comment=$newcomment;
              $comment->user_id=auth()->user()->id;
              $comment->application_id=$app->id;
              $comment->save();
          }









        return back();


    }

    public function details($id)
    {

        $application = Application::with('client', 'source', 'status', 'product', 'car.models', 'comments.user', 'user',
            'companies')
            ->find($id);

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();
        $cars      = Car::with('models')->get();
        $models    = CarModel::all();
//        dd($cars);
        $carsJson = $cars->toJson();

        return view('pages.detailed',
            compact('application', 'companies', 'statuses', 'products', 'sources', 'carsJson', 'models'));

    }

}