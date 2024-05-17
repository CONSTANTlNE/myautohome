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
use Illuminate\Support\Facades\Validator;

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

        $application = Application::with('client', 'source', 'status', 'product', 'car', 'comments.user', 'user',
            'companies','model')
            ->find($id);

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();
        $products  = Product::all();

        return view('pages.editapp',
            compact('application', 'companies', 'statuses', 'products', 'sources',));

    }

    public function update(Request $request)
    {

        $app = Application::with('client', 'source', 'status', 'product', 'car', 'comments.user', 'user',
            'companies','model')
            ->find($request->id);

        $allcompanies = Company::all();
        $statuses=Status::all();
        $sources=Source::all();
        $products=Product::all();
         $cars=Car::all();
         $models=CarModel::all();

//dd($request->status);
        if ($app->status->id != $request->status) {
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა სტატუსი: -- '.$app->status->name. ' -- ახალი სტატუსია: --'. $statuses->where('id',$request->status)->first()->name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);

            $app->status_id = $request->status;
            $app->save();

            echo 'status changed';

        }

        if ($app->client->pid !== $request->customer_pid) {
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა პირადი ნომერი: -- '.$app->client->pid. ' -- ახალი პირადი ნომერია: --'.$request->customer_pid.
                '-- ცვლილება განახორციელა '.auth()->user()->name);

            $app->client->pid = $request->customer_pid;
            $app->client->save();

            echo 'pid changed';

        }
        if ($app->client->name !== $request->customer_name) {

            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა კლიენტი: -- '.$app->client->name. ' -- ახალი კლიენტია: --'.$request->customer_name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);



            echo 'customer name changed';

        }

        if ($app->client->mobile1 !== $request->customer_mobile) {

            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა კლიენტის მობილური: -- '.$app->client->mobile1. ' -- ახალი მობილურია: --'.$request->customer_mobile.
                '-- ცვლილება განახორციელა '.auth()->user()->name);

            echo 'customer mobile changed';

        }

        if ($app->source->id != $request->source) {
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა წყარო: -- '.$app->source->name. '-- ახალი წყაროა: -- '.$sources->where('id', $request->source)->first()->name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
            echo 'source changed';
        }

        if ($app->product->id != $request->product) {
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა პროდუცტი: -- '.$app->product->name. ' -- ახალი პროდუქტია: --'.$products->where('id',$request->product)->first()->name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
            echo 'product changed';
        }


        if ($app->link !== $request->link) {
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა ლინკი: --  '.$app->link. ' -- ახალი ლინკია: -- '.$request->link.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
            echo 'link changed';

        }


        if ($app->car_id != $request->car) {

            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა მანქანა: -- '.$app->car->make. ' -- ახალი მანქანაა: -- '.$cars->where('id', $request->car)->first()->name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
            echo 'car changed';
        }


        if ($app->car_model_id != $request->model) {

            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა მანქანის მოდელი: --'.$app->model->name. '-- ახალი მანქანის მოდელია: --'.$models->where('id', $request->model)->first()->name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
            echo 'car model changed';

        }

        if ($app->year != $request->year) {

            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა მანქანის წელი: --'.$app->year. '-- ახალი წელია: --'.$request->year.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
            echo 'car year changed';
        }

        if ($app->engine != $request->engine) {
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა ძრავის მოცულობა: --'.$app->engine. '-- ახალი წელია: --'.$request->engine.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
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
//        dd($commentids);
          $comments=$request->oldcomment;
          $appcomments=$app->comments;

          // update existing comment
        if($commentids!=null) {
            foreach ($commentids as $index => $commentid) {
                // if comment changed
                $comment = $appcomments->where('id', $commentid)->first();
                if ($comment->comment != $comments[$index]) {
                    $comment->comment = $comments[$index];
                    $comment->user_id = auth()->user()->id;
                    $comment->save();
                }
            }

            foreach ($request->newcomment as $newcomment) {
                $comment                 = new Comment();
                $comment->comment        = $newcomment;
                $comment->user_id        = auth()->user()->id;
                $comment->application_id = $app->id;
                $comment->save();
            }
        }










    }

    public function details($id)
    {

        $application = Application::with('client', 'source', 'status', 'product', 'car', 'comments.user', 'user',
            'companies','model')
            ->find($id);

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();



        return view('pages.detailed',
            compact('application', 'companies', 'statuses', 'products', 'sources', ));

    }





//    ============== HTMX ==================

    public function htmxedit($id)
    {

        $application = Application::with('client', 'source', 'status', 'product', 'car', 'comments.user', 'user',
            'companies','model')
            ->find($id);


        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();
        $cars      = Car::all();

//

        return view('htmx.htmxeditapp',
            compact('application', 'companies', 'statuses', 'products', 'sources', 'cars'));

    }


    public function htmxstore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'customer_pid' => 'required',
            'customer_name'=>'nullable|string',
            'customer_mobile'=>'nullable|numeric|digits:9',
        ]);


        if ($validator->fails()) {
//            return view('')->withErrors($validator);
            return view('htmx.errors' )->withErrors($validator);
        }


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
        $app->client_id    = $client->id;
        $app->save();

        $app->source_id    = $request->source;
        $app->status_id    = $request->status;
        $app->product_id   = $request->product;
        $app->car_id       = $request->car;
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

        if($request->company) {
            $app->companies()->attach($request->company);
        }


        // Returning HTMX VIEW


        if($request->session()->has('request_counter')) {
            $counter = $request->session()->get('request_counter')+1;
            $request->session()->put('request_counter', $counter);

        } else {
            $counter = 1;
            $request->session()->put('request_counter', $counter);
        }

        $applications = Application::with([
            'client:id,name,mobile1,pid',
            'source:id,name',
            'status:id,name',
            'product:id,name',
            'car:id,make',
            'comments.user:id,name',
            'user:id,name',
            'companies:id,name'
        ])  ->latest()
            ->limit(300)
            ->get();

        $companies=Company::all();
        $statuses=Status::all();
        $products=Product::all();
        $sources=Source::all();
//        $cars=Car::with('models')->get();
        $cars=Car::all();

//        $carsJson =$cars->toJson();
        return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars','counter'));

    }


    public function htmxdetails($id){

        $application = Application::with('client', 'source', 'status', 'product', 'car', 'comments.user', 'user',
            'companies','model')
            ->find($id);

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();


        return view('htmx.htmxdetailed',
            compact('application', 'companies', 'statuses', 'products', 'sources', ));
    }

}