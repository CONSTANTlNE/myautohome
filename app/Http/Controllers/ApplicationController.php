<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Client;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Notification;
use App\Models\PotentialClient;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
use App\Models\User;
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


        $validate = Validator::make($request->all(), [
            'customer_pid'    => 'required',
            'customer_name'   => 'required|string',
            'customer_mobile' => 'required|integer',
            'source'          => 'required|integer|exists:sources,id',
            'status'          => 'required|integer|exists:statuses,id',
            'product'         => 'required|integer|exists:products,id',
            'company'         => 'required|array',
            'company.*'       => 'integer|exists:companies,id',
            'car'             => 'nullable|integer|exists:cars,id',
            'model'           => 'nullable|integer|exists:car_models,id',
            'link'            => 'nullable|string',
            'engine'          => 'nullable|numeric',
            'year'            => 'nullable|integer',
            'comment'         => 'nullable|string',
        ]);






        // If laravel validation fails return HTMX error page
        if ($validate->fails()) {
            $errors = $validate->errors();
            return view('htmx.errors')->with('errors', $errors);
        }


        $validated = $validate->validated();




        $user=auth()->user()->id;

        $client = Client::firstOrCreate(
            ['pid' => $validated['customer_pid']],
            [
                'name'    => $validated['customer_name'],
                'mobile1' => $validated['customer_mobile']
            ]
        );

        // if Exists , remove potential clients and add in clients

        $potentialclients=PotentialClient::all();
        foreach ($potentialclients as $potentialclient) {
            if ($potentialclient->mobile ==$client->mobile1) {
                $potentialclient->delete();
            }

                if($potentialclient->pid == $client->pid){
                $potentialclient->delete();

            }

            if ($potentialclient->name == $client->name) {
                $potentialclient->delete();
            }

        }



        $app = Application::create([
            'number'       => $letters.'-'.$digits,
            'user_id'      => $user,
            'source_id'    => $validated['source'],
            'status_id'    => $validated['status'],
            'product_id'   => $validated['product'],
            'car_id'       => $validated['car'],
            'client_id'    => $client->id,
            'car_model_id' => $validated['model'],
            'link'         => $validated['link'],
            'engine'       => $validated['engine'],
            'year'         => $validated['year']
        ]);

        if ($request->comment) {
            $app->comments()->create([
                'user_id' => $user,
                'comment' => $validated['comment']
            ]);
        }

        $app->companies()->attach($validated['company']);


        return back();

    }

    public function edit($id)
    {

        $application = Application::with('client', 'source', 'status', 'product', 'car', 'comments.user', 'user',
            'companies', 'model')
            ->find($id);

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();
        $products  = Product::all();
        $cars      = Car::all();

        return view('pages.editapp',
            compact('application', 'companies', 'statuses', 'products', 'sources','cars','products'));

    }

    public function update(Request $request)
    {

        $app = Application::with('client', 'source', 'status', 'product', 'car', 'comments.user', 'user',
            'companies', 'model')
            ->find($request->id);

        $companies = Company::all();
        $statuses     = Status::all();
        $sources      = Source::all();
        $products     = Product::all();
        $cars         = Car::all();
        $models       = CarModel::all();

//dd($request->status);
        if ($app->status->id != $request->status) {
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა სტატუსი: -- '.$app->status->name.' -- ახალი სტატუსია: --'.$statuses->where('id',
                    $request->status)->first()->name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);

            $app->status_id = $request->status;
            $app->save();

            echo 'status changed';

        }

        if ($app->client->pid !== $request->customer_pid) {
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა პირადი ნომერი: -- '.$app->client->pid.' -- ახალი პირადი ნომერია: --'.$request->customer_pid.
                '-- ცვლილება განახორციელა '.auth()->user()->name);

            $app->client->pid = $request->customer_pid;
            $app->client->save();

            echo 'pid changed';

        }
        if ($app->client->name !== $request->customer_name) {

            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა კლიენტი: -- '.$app->client->name.' -- ახალი კლიენტია: --'.$request->customer_name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);


            echo 'customer name changed';

        }

        if ($app->client->mobile1 !== $request->customer_mobile) {

            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა კლიენტის მობილური: -- '.$app->client->mobile1.' -- ახალი მობილურია: --'.$request->customer_mobile.
                '-- ცვლილება განახორციელა '.auth()->user()->name);

            echo 'customer mobile changed';

        }

        if ($app->source->id != $request->source) {
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა წყარო: -- '.$app->source->name.'-- ახალი წყაროა: -- '.$sources->where('id',
                    $request->source)->first()->name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
            echo 'source changed';
        }

        if ($app->product->id != $request->product) {
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა პროდუცტი: -- '.$app->product->name.' -- ახალი პროდუქტია: --'.$products->where('id',
                    $request->product)->first()->name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
            echo 'product changed';
        }


        if ($app->link !== $request->link) {
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა ლინკი: --  '.$app->link.' -- ახალი ლინკია: -- '.$request->link.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
            echo 'link changed';

        }


        if ($app->car_id != $request->car) {

            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა მანქანა: -- '.$app->car->make.' -- ახალი მანქანაა: -- '.$cars->where('id',
                    $request->car)->first()->name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
            echo 'car changed';
        }


        if ($app->car_model_id != $request->model) {

            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა მანქანის მოდელი: --'.$app->model->name.'-- ახალი მანქანის მოდელია: --'.$models->where('id',
                    $request->model)->first()->name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
            echo 'car model changed';

        }

        if ($app->year != $request->year) {

            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა მანქანის წელი: --'.$app->year.'-- ახალი წელია: --'.$request->year.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
            echo 'car year changed';
        }

        if ($app->engine != $request->engine) {
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა ძრავის მოცულობა: --'.$app->engine.'-- ახალი წელია: --'.$request->engine.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
            echo 'car engine changed';
        }


        //  Attach new or change company
        foreach ($request['company'] as $company) {
            if (!in_array($company, $app->companies->pluck('id')->toArray())) {
                Log::channel('changes')->info('განაცხადში No: '.$app->number.'  ჩაემატა კომპანია: '.$companies->where('id',
                        $company)->first()->name.'-- ოპერატორი '.auth()->user()->name);
                $app->companies()->attach($company);
            }
        }

        //  Detach company if removed
        foreach ($app->companies as $company) {
            if (!in_array($company->id, $request['company'])) {
                Log::channel('changes')->info('განაცხადში No: '.$app->number.'  წაიშალა კომპანია: '.$companies->where('id',
                        $company->id)->first()->name.'-- ოპერატორი '.auth()->user()->name);
                $app->companies()->detach($company->id);
            }
        }


        $commentids = $request->commentids;
//        dd($commentids);
        $comments    = $request->oldcomment;
        $appcomments = $app->comments;

        // update existing comment
        if ($commentids != null) {
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
            'companies', 'model')
            ->find($id);

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();


        return view('pages.detailed',
            compact('application', 'companies', 'statuses', 'products', 'sources',));

    }


//    ============== HTMX  ==================

    public function htmxedit($id)
    {

        $application = Application::with('client', 'source', 'status', 'product', 'car', 'comments.user', 'user',
            'companies', 'model')
            ->find($id);

       $userid=auth()->user()->id;
        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();
        $cars      = Car::all();

//

        return view('htmx.htmxeditapp',
            compact('application', 'companies', 'statuses', 'products', 'sources', 'cars','userid'));

    }


    public function htmxstore(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'customer_pid'    => 'required',
            'customer_name'   => 'required|string',
            'customer_mobile' => 'required|integer',
            'source'          => 'required|integer|exists:sources,id',
            'status'          => 'required|integer|exists:statuses,id',
            'product'         => 'required|integer|exists:products,id',
            'company'         => 'required|array',
            'company.*'       => 'integer|exists:companies,id',
            'car'             => 'nullable|integer|exists:cars,id',
            'model'           => 'nullable|integer|exists:car_models,id',
            'link'            => 'nullable|string',
            'engine'          => 'nullable|float',
            'year'            => 'nullable|integer',
            'newcomment'        => 'nullable|array',
            'newcomment.*'      => 'string',
        ]);


        if ($validate->fails()) {
            $errors = $validate->errors();

            return response()->view('htmx.errors', compact('errors'))->setStatusCode(500);
        }


        $letters = chr(random_int(65, 90)).chr(random_int(65, 90)).chr(random_int(65,
                90));
        $digits  = str_pad(random_int(0, 999), 3, '0',
            STR_PAD_LEFT);


        $validated = $validate->validated();
        $user=auth()->user()->id;

        $client = Client::firstOrCreate(
            ['pid' => $validated['customer_pid']],
            [
                'name'    => $validated['customer_name'],
                'mobile1' => $validated['customer_mobile']
            ]
        );


        $potentialclients=PotentialClient::all();
        foreach ($potentialclients as $potentialclient) {
            if ($potentialclient->mobile ==$client->mobile1) {
                $potentialclient->delete();
            }

            if($potentialclient->pid == $client->pid){
                $potentialclient->delete();

            }

            if ($potentialclient->name == $client->name) {
                $potentialclient->delete();
            }

        }

        $app = Application::create([
            'number'       => $letters.'-'.$digits,
            'user_id'      => $user,
            'source_id'    => $validated['source'],
            'status_id'    => $validated['status'],
            'product_id'   => $validated['product'],
            'car_id'       => $validated['car'],
            'client_id'    => $client->id,
            'car_model_id' => $validated['model'],
            'link'         => $validated['link'],
            'engine'       => $validated['engine'],
            'year'         => $validated['year']
        ]);

        if ($request->comment) {
            $app->comments()->create([
                'user_id' => $user,
                'comment' => $validated['newcomment']
            ]);
        }

        $app->companies()->attach($validated['company']);


        // Returning HTMX VIEW with table to main page

        if ($request->session()->has('request_counter')) {
            $counter = $request->session()->get('request_counter') + 1;
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
        ])->orderBy('created_at', 'desc')
            ->latest()
            ->limit(300)
            ->get();

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();
//        $cars=Car::with('models')->get();
        $cars = Car::all();

//        $carsJson =$cars->toJson();
        return view('htmx.htmx',
            compact('companies', 'statuses', 'products', 'sources', 'applications', 'cars', 'counter'));

    }


    public function htmxdetails($id)
    {

        $application = Application::with('client', 'source', 'status', 'product', 'car', 'comments.user', 'user',
            'companies', 'model')
            ->find($id);

        $companies = Company::all();
        $statuses  = Status::all();
        $products  = Product::all();
        $sources   = Source::all();


        return view('htmx.htmxdetailed',
            compact('application', 'companies', 'statuses', 'products', 'sources',));
    }



    // For users for their applications
public function htmxupdate(Request $request){

//    DATA FOR HTMX VIEW with table to main page

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
        'status',
        'product:id,name',
        'car:id,make',
        'comments.user:id,name',
        'user:id,name',
        'companies:id,name'
    ])  ->orderBy('created_at', 'desc')
        ->latest()
        ->limit(300)
        ->get();







//    START UPDATING LOGIC

    $app = Application::with('client', 'source', 'status', 'product', 'car', 'comments.user', 'user',
        'companies', 'model')
        ->find($request->id);

    $companies = Company::all();
    $statuses     = Status::all();
    $sources      = Source::all();
    $products     = Product::all();
    $cars         = Car::all();
    $models       = CarModel::all();
    $users        = User::all();



    $validate = Validator::make($request->all(), [
        'customer_pid'    => 'required',
        'customer_name'   => 'required|string',
        'customer_mobile' => 'required|integer',
        'source'          => 'required|integer|exists:sources,id',
        'status'          => 'required|integer|exists:statuses,id',
        'product'         => 'required|integer|exists:products,id',
        'company'         => 'required|array',
        'company.*'       => 'integer|exists:companies,id',
        'car'             => 'nullable|integer|exists:cars,id',
        'model'           => 'nullable|integer|exists:car_models,id',
        'link'            => 'nullable|string',
        'engine'          => 'nullable|numeric',
        'year'            => 'nullable|integer',
        'comment'         => 'nullable|string',
        'commentids'      => 'nullable|array',
        'commentids.*'    => 'integer|exists:comments,id',
        'oldcomment'      => 'nullable|array',
        'oldcomment.*'    => 'string',
        'newcomment'      => 'nullable|array',
        'newcomment.*'    => 'string',
    ]);


    if ($validate->fails()) {
        $errors = $validate->errors();
        return view('htmx.errors')->with('errors', $errors);
    }


    $validated = $validate->validated();



//dd($request->status);
    if ($app->status->id != $validated['status']) {
        Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა სტატუსი: -- '.$app->status->name.' -- ახალი სტატუსია: --'.$statuses->where('id',
                $request->status)->first()->name.
            '-- ცვლილება განახორციელა '.auth()->user()->name);

        foreach ($users as $user) {
            if($user->id!=$app->user_id){
                $notification = new Notification();
                $notification->application_id = $app->id;
                $notification->user_id        = $user->id;
                $notification->type           = 'შეიცვალა სტატუსი';
                $notification->save();
            }
        }

        $app->status_id = $validated['status'];
        $app->save();

        return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars','counter'));


    }

    if ($app->client->pid !== $validated['customer_pid']) {
        Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა პირადი ნომერი: -- '.$app->client->pid.' -- ახალი პირადი ნომერია: --'.$request->customer_pid.
            '-- ცვლილება განახორციელა '.auth()->user()->name);

        foreach ($users as $user) {
            if($user->id!=$app->user_id){
                $notification = new Notification();
                $notification->application_id = $app->id;
                $notification->user_id        = $user->id;
                $notification->type           = 'შეიცვალა კლიენტის პირადობა';
                $notification->save();
            }
        }

        $app->client->pid = $validated['customer_pid'];
        $app->client->save();



        return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars','counter'));


    }
    if ($app->client->name !== $validated['customer_name']) {

        Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა კლიენტი: -- '.$app->client->name.' -- ახალი კლიენტია: --'.$request->customer_name.
            '-- ცვლილება განახორციელა '.auth()->user()->name);

        foreach ($users as $user) {
            if($user->id!=$app->user_id){
                $notification = new Notification();
                $notification->application_id = $app->id;
                $notification->user_id        = $user->id;
                $notification->type           = 'შეიცვალა კლიენტის სახელი ';
                $notification->save();
            }
        }

        $app->client->name = $validated['customer_name'];
        $app->client->save();
        return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars','counter'));


    }

    if ($app->client->mobile1 !== $validated['customer_mobile']) {

        Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა კლიენტის მობილური: -- '.$app->client->mobile1.' -- ახალი მობილურია: --'.$request->customer_mobile.
            '-- ცვლილება განახორციელა '.auth()->user()->name);

        foreach ($users as $user) {
            if($user->id!=$app->user_id){
                $notification = new Notification();
                $notification->application_id = $app->id;
                $notification->user_id        = $user->id;
                $notification->type           = 'შეიცვალა კლიენტის საკონტაქტო ';
                $notification->save();
            }
        }

        $app->client->mobile1 = $validated['customer_mobile'];
        $app->client->save();

        return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars','counter'));


    }

    if ($app->source->id != $validated['source']) {
        Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა წყარო: -- '.$app->source->name.'-- ახალი წყაროა: -- '.$sources->where('id',
                $request->source)->first()->name.
            '-- ცვლილება განახორციელა '.auth()->user()->name);

        foreach ($users as $user) {
            if($user->id!=$app->user_id){
                $notification = new Notification();
                $notification->application_id = $app->id;
                $notification->user_id        = $user->id;
                $notification->type           = 'შეიცვალა წყარო';
                $notification->save();
            }
        }


        $app->source_id=$validated['source'];
        $app->save();
        return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars','counter'));

    }

    if ($app->product->id != $validated['product']) {
        Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა პროდუცტი: -- '.$app->product->name.' -- ახალი პროდუქტია: --'.$products->where('id',
                $request->product)->first()->name.
            '-- ცვლილება განახორციელა '.auth()->user()->name);

        foreach ($users as $user) {
            if($user->id!=$app->user_id){
                $notification = new Notification();
                $notification->application_id = $app->id;
                $notification->user_id        = $user->id;
                $notification->type           = 'შეიცვალა პროდუქტი';
                $notification->save();
            }
        }

        $app->product_id  = $validated['product'];
        $app->save();
        return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars','counter'));

    }


    if ($app->link !== $validated['link']) {
        Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა ლინკი: --  '.$app->link.' -- ახალი ლინკია: -- '.$request->link.
            '-- ცვლილება განახორციელა '.auth()->user()->name);

        foreach ($users as $user) {
            if($user->id!=$app->user_id){
                $notification = new Notification();
                $notification->application_id = $app->id;
                $notification->user_id        = $user->id;
                $notification->type           = 'შეიცვალა ლინკი';
                $notification->save();
            }
        }

        $app->link = $validated['link'];
        $app->save();
        return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars','counter'));

    }


    if ($validated['car']!==null && $app->car_id!=$validated['car']) {
        if($app->car===null){
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა მანქანა: -- '. '----------'.' -- ახალი მანქანა: -- '.$cars->where('id',
                    $request->car)->first()->name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);

        }else{
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა მანქანა: -- '.  $app->car->make.' -- ახალი მანქანა: -- '.$cars->where('id',
                    $request->car)->first()->name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
        }

        foreach ($users as $user) {
            if($user->id!=$app->user_id){
                $notification = new Notification();
                $notification->application_id = $app->id;
                $notification->user_id        = $user->id;
                $notification->type           = 'შეიცვალა მწარმოებელი';
                $notification->save();
            }
        }

        $app->car_id = $validated['car'];
        $app->update();

    }


    if ($validated['model']!==null && $app->car_model_id!=$validated['model']) {
        if($app->car_model_id==null){
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა მანქანის მოდელი: --'. '----------'.'-- ახალი მანქანის მოდელია: --'.$models->where('id',
                    $request->model)->first()->name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
        } else {
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა მანქანის მოდელი: --'.  $app->model->name .'-- ახალი მანქანის მოდელია: --'.$models->where('id',
                    $request->model)->first()->name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);
        }

        foreach ($users as $user) {
            if($user->id!=$app->user_id){
                $notification = new Notification();
                $notification->application_id = $app->id;
                $notification->user_id        = $user->id;
                $notification->type           = 'შეიცვალა მანქანის მოდელი';
                $notification->save();
            }
        }

        $app->car_model_id = $validated['model'];
        $app->save();
        return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars','counter'));

    }

    if ($app->year !== $validated['year']) {

        Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა მანქანის წელი: --'.$app->year.'-- ახალი წელია: --'.$request->year.
            '-- ცვლილება განახორციელა '.auth()->user()->name);

        foreach ($users as $user) {
            if($user->id!=$app->user_id){
                $notification = new Notification();
                $notification->application_id = $app->id;
                $notification->user_id        = $user->id;
                $notification->type           = 'შეიცვალა ავტომობილის წელი';
                $notification->save();
            }
        }

        $app->year=$request->year;
        $app->save();
        return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars','counter'));

    }

    if ($app->engine !== $validated['engine']) {
        Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა ძრავის მოცულობა: --'.$app->engine.'-- ახალი წელია: --'.$request->engine.
            '-- ცვლილება განახორციელა '.auth()->user()->name);

        foreach ($users as $user) {
            if($user->id!=$app->user_id){
                $notification = new Notification();
                $notification->application_id = $app->id;
                $notification->user_id        = $user->id;
                $notification->type           = 'შეიცვალა ძრავის მოცულობა';
                $notification->save();
            }
        }
        $app->engine = $validated['engine'];
        $app->save();
        return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars','counter'));

    }


    //  Attach new or change company
    foreach ($validated['company'] as $company) {

        if (!in_array($company, $app->companies->pluck('id')->toArray())) {
            foreach ($users as $user) {
                if($user->id!=$app->user_id){
                    $notification = new Notification();
                    $notification->application_id = $app->id;
                    $notification->user_id        = $user->id;
                    $notification->type           = 'დაემატა კომპანია ';
                    $notification->save();
                }
            }


            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  დაემატა კომპანია: '.$companies->where('id',
                    $company)->first()->name.'-- ოპერატორი '.auth()->user()->name);
            $app->companies()->attach($company);
        }
    }

    //  Detach company if removed
    foreach ($app->companies as $company) {
        if (!in_array($company->id, $validated['company'])) {
            foreach ($users as $user) {
                if($user->id!=$app->user_id){
                    $notification = new Notification();
                    $notification->application_id = $app->id;
                    $notification->user_id        = $user->id;
                    $notification->type           = 'წაიშალა კომპანია';
                    $notification->save();
                }

            }

            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  წაიშალა კომპანია: '.$companies->where('id',
                    $company->id)->first()->name.'-- ოპერატორი '.auth()->user()->name);
            $app->companies()->detach($company->id);
        }
    }

     if($request->has('commentids')){


         // COMMENTS
    $commentids = $validated['commentids'];
    $comments    = $validated['oldcomment'];
    $appcomments = $app->comments;


    // update existing comment
        foreach ($commentids as $index => $commentid) {
            // if comment changed
            $comment = $appcomments->where('id', $commentid)->first();
            if ($comment->comment != $comments[$index]) {
                $comment->comment = $comments[$index];
                $comment->user_id = auth()->user()->id;
                $comment->save();
            }
        }
    }

     if($request->has('newcomment')){
         foreach ($users as $user) {
             if($user->id != auth()->user()->id){
                 $notification = new Notification();
                 $notification->application_id = $app->id;
                 $notification->user_id        = $user->id;
                 $notification->type           = 'დაემატა ახალი კომენტარი';
                 $notification->save();
             }
         }

         foreach ($validated['newcomment'] as $newcomment) {
             $comment                 = new Comment();
             $comment->comment        = $newcomment;
             $comment->user_id        = auth()->user()->id;
             $comment->application_id = $app->id;
             $comment->save();

         }
     }



    return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars','counter'));


}



// update only status and comment by other users
    public function htmxupdate2(Request $request){

        $app = Application::with('client', 'source', 'status', 'product', 'car', 'comments.user', 'user',
            'companies', 'model')
            ->find($request->id);


        $companies=Company::all();
        $statuses=Status::all();
        $products=Product::all();
        $sources=Source::all();
//        $cars=Car::with('models')->get();
        $cars=Car::all();
        $users=User::all();

        // update Logic
        if ($app->status->id != $request->status) {
            Log::channel('changes')->info('განაცხადში No: '.$app->number.'  შეიცვალა სტატუსი: -- '.$app->status->name.' -- ახალი სტატუსია: --'.$statuses->where('id',
                    $request->status)->first()->name.
                '-- ცვლილება განახორციელა '.auth()->user()->name);

            $app->status_id = $request->status;
            $app->save();

            echo 'status changed';

        }



        $commentids = $request->commentids;
//        dd($commentids);
        $comments    = $request->oldcomment;
        $appcomments = $app->comments;

        // update existing comment
        if ($commentids != null) {
            foreach ($commentids as $index => $commentid) {
                // if comment changed
                $comment = $appcomments->where('id', $commentid)->first();
                if ($comment->comment != $comments[$index]) {
                    $comment->comment = $comments[$index];
                    $comment->user_id = auth()->user()->id;
                    $comment->save();
                }
            }

        }


        if($request->has('newcomment')){
            foreach ($users as $user) {
                if($user->id != auth()->user()->id){
                    $notification = new Notification();
                    $notification->application_id = $app->id;
                    $notification->user_id        = $user->id;
                    $notification->type           = 'დაემატა ახალი კომენტარი';
                    $notification->save();
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


        // RETURN HTML VIEW

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
            'status',
            'product:id,name',
            'car:id,make',
            'comments.user:id,name',
            'user:id,name',
            'companies:id,name'
        ])  ->orderBy('created_at', 'desc')
            ->latest()
            ->limit(300)
            ->get();


        return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars','counter'));


    }



}

