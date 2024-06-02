<?php

use App\CustomAuthenticatedSessionController;
use App\Http\Controllers\AllowedipController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LogViewerController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\PotentialStatusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Models\Application;
use App\Models\Car;
use App\Models\Client;
use App\Models\Company;
use App\Models\Notification;
use App\Models\PotentialClient;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::fallback(function () {
    return redirect()->route('main');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/',[MainController::class, 'index'])->name('main');
    Route::get('/search',[MainController::class, 'appsearch'])->name('search.app');
    Route::get('/clear',[MainController::class, 'clearSearch'])->name('search.clear');



    // HTMX routes
    Route::get('/htmx',[MainController::class, 'index2'])->name('main2');

    // app htmx
    Route::get('/searchhtmx',[MainController::class, 'htmxsearch'])->name('search.htmx');
    Route::get('htmx/edit/{id}',[ApplicationController::class, 'htmxedit'])->name('edit.htmx');
    // for users who can change their applications
    Route::post('htmx/update',[ApplicationController::class, 'htmxupdate'])->name('update.htmx');
    // for users who can change only status and comment
    Route::post('htmx/update2',[ApplicationController::class, 'htmxupdate2'])->name('update2.htmx');
    Route::post('htmx/app/create',[ApplicationController::class, 'htmxstore'])->name('htmxstore');
    Route::get('htmx/details/{id}',[ApplicationController::class, 'htmxdetails'])->name('htmxdetails');
    Route::get('htmx/delete/{id}',[ApplicationController::class, 'htmxdelete'])->name('app.htmx.deletete');
    Route::post('htmx/app/destroy',[ApplicationController::class, 'htmxdestroy'])->name('app.htmx.destroy');
    Route::post('htmx/potential/destroy',[ClientController::class, 'htmxdestroypotential'])->name('potential.htmx.deletete');

    Route::get('htmx/carsearch',[MainController::class, 'carsearch'])->name('carsearch');

    Route::get('/htmx/admin/users',[UserController::class, 'htmxindex'])->name('htmx.users');
    Route::post('/admin/htmx/user/create',[UserController::class, 'htmxstore'])->name('user.htmxcreate');
    Route::get('/admin/htmx/manage',[PanelController::class, 'htmxindex'])->name('htmx.other');
    Route::post('/admin/source/create',[SourceController::class, 'store'])->name('source.create');
    Route::post('/admin/source/update',[SourceController::class, 'update'])->name('source.update');
    Route::post('/admin/status/create',[StatusController::class, 'store'])->name('status.create');
    Route::post('/admin/status/update',[StatusController::class, 'update'])->name('status.update');
    Route::post('/admin/product/create',[ProductController::class, 'store'])->name('product.create');
    Route::post('/admin/product/update',[ProductController::class, 'update'])->name('product.update');


    //  Admin
    Route::get('/admin/users',[UserController::class, 'index'])->name('users');
//    Route::get('/admin/manage',[PanelController::class, 'manage'])->name('other');
    Route::get('/admin/manage',[PanelController::class, 'index'])->name('other');
    Route::post('/admin/cars/add',[PanelController::class, 'addCar'])->name('cars.add');
    Route::post('/admin/company/create',[CompanyController::class, 'store'])->name('company.create');
    Route::post('/admin/company/update',[CompanyController::class, 'update'])->name('company.update');


    Route::post('/admin/user/create',[UserController::class, 'store'])->name('user.create');
    Route::get('/admin/user/applications/{id}',[UserController::class, 'userapps'])->name('user.apps');
    Route::post('/admin/user/password/change',[UserController::class, 'changeUserPassword'])->name('user.password.change');
    Route::post('/daterange',[MainController::class, 'dateRange'])->name('date.range');
    Route::post('/htmx/daterange',[MainController::class, 'htmxdateRange'])->name('htmx.date.range');




    // App - for testing only, not in production
    Route::post('app/create',[ApplicationController::class, 'store'])->name('app.create');
    Route::get('app/edit/{id}',[ApplicationController::class, 'edit'])->name('app.edit');
    Route::post('app/update',[ApplicationController::class, 'update'])->name('app.update');
    Route::get('app/details/{id}',[ApplicationController::class, 'details'])->name('app.details');



    // clients - for testing only, not in production
    Route::get('app/clients/existing',[ClientController::class, 'existingIndex'])->name('existing.clients');
    Route::get('app/clients/potential',[ClientController::class, 'potentialIndex'])->name('potential.clients');
    Route::post('app/clients/potential/create',[ClientController::class, 'createPotential'])->name('potential.clients.create');
    Route::post('app/clients/potential/update',[ClientController::class, 'updatePotential'])->name('potential.clients.update');


    // Clients HTMX
    Route::get('/clients/potential/index/htmx',[ClientController::class, 'htmxpotentialIndex'])->name('htmx.potential.clients');
    Route::post('/clients/potential/htmx/create',[ClientController::class, 'htmxcreatePotential'])->name('htmx.potential.clients.create');
    Route::post('/clients/potential/htmx/update',[ClientController::class, 'htmxupdatePotential'])->name('htmx.potential.clients.update');
    Route::post('/clients/potential/htmx/daterange',[ClientController::class, 'htmxclientdaterange'])->name('htmx.potential.clients.daterange');
    Route::get('/clients/potential/htmx/search',[ClientController::class, 'htmxsearchpotential'])->name('search.potential.htmx');
    Route::get('/clients/potential/htmx/search/edit/{id}',[ClientController::class, 'editsearchpotential'])->name('edit.search.potential');
    Route::post('/clients/potential/status/create/htmx',[PotentialStatusController::class, 'createpotentialstatus'])->name('htmx.potential.status.create');
    Route::post('/clients/potential/status/update/htmx',[PotentialStatusController::class, 'updatepotentialstatus'])->name('htmx.potential.status.update');


    // changepassword
    Route::post('password/change',[UserController::class, 'changePassword'])->name('password.change');

    // SSE
    Route::get('/notifications/sse', [NotificationController::class, 'sse'])->name('sse');
    Route::get('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark.as.read');
    Route::get('/htmx/notifications', [NotificationController::class, 'showheader'])->name('htmx.notifications');

    // log viewer
    Route::get('/log-viewer?file=7d22837e-changes.log&query=+{query}', [LogViewerController::class, 'show'])->name('customlogviewer');

    // IPS
    Route::get('/htmx/ips', [AllowedipController::class, 'index'])->name('ips');
    Route::get('/htmx/ips/create', [AllowedipController::class, 'create'])->name('htmx.create');
    Route::post('/htmx/ips/store', [AllowedipController::class, 'store'])->name('ips.store');
    Route::post('/htmx/ips/delete', [AllowedipController::class, 'destroy'])->name('ips.destroy');

});

// Uploads
Route::get('/uploads',[UploadController::class, 'index'])->name('upload.index');

Route::post('/uploads/cars',[UploadController::class, 'carUpload'])->name('upload.cars');
Route::post('/uploads/data',[UploadController::class, 'dataUpload'])->name('upload.data');
Route::post('/uploads/potential',[UploadController::class, 'potentialUpload'])->name('upload.potential');
Route::get('randuser',function(){
    return User::inRandomOrder()->first()->id;
});




// for different testing


Route::get('memory',function(){

    $memoryUsage = memory_get_usage();
    $memoryUsageMB = $memoryUsage / 1048576;
    echo 'Current memory usage: ' . $memoryUsageMB . ' MB';
});


Route::get('deletepotential',function(Request $request){

 $potentials=PotentialClient::all();
 foreach ($potentials as $potential){
     $potential->delete();
 }




});

Route::get('deletenotification',function(Request $request){

    $notifications=Notification::all();
    foreach ($notifications as $notification){
        $notification->delete();
    }

});





Route::get('test',function(Request $request){

    $applications = Application::with([
        'client:id,name,mobile1,pid',
        'source:id,name',
        'status:id,name,color',
        'product:id,name',
//            'car:id,make',
        'comments.user:id,name',
        'user:id,name',
//            'companies:id,name'
    ])  ->orderBy('created_at', 'desc')
        ->latest()
        ->get();

    $companies=Company::all();
    $statuses=Status::all();
    $products=Product::all();
    $sources=Source::all();
    $cars=Car::all();
    $authuser=auth()->user();

//        $carsJson =$cars->toJson();
    return view('tests.alldata' ,compact('companies','statuses','products','sources','applications','cars','authuser'));


});
