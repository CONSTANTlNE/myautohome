<?php

use App\CustomAuthenticatedSessionController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LogViewerController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


//
//Route::get('/', function () {
//    return view('login');
//});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/',[MainController::class, 'index'])->name('main');
    Route::get('/search',[MainController::class, 'appsearch'])->name('search.app');
    Route::get('/clear',[MainController::class, 'clearSearch'])->name('search.clear');


    // HTMX routes
    Route::get('/htmx',[MainController::class, 'index2'])->name('main2');
    Route::get('/searchhtmx',[MainController::class, 'htmxsearch'])->name('search.htmx');
    Route::get('htmx/edit/{id}',[ApplicationController::class, 'htmxedit'])->name('edit.htmx');
    // for users who can change their applications
    Route::post('htmx/update',[ApplicationController::class, 'htmxupdate'])->name('update.htmx');
    // for users who can change only status and comment
    Route::post('htmx/update2',[ApplicationController::class, 'htmxupdate2'])->name('update2.htmx');
    Route::get('htmx/carsearch',[MainController::class, 'carsearch'])->name('carsearch');
    Route::post('htmx/app/create',[ApplicationController::class, 'htmxstore'])->name('htmxstore');
    Route::get('htmx/details/{id}',[ApplicationController::class, 'htmxdetails'])->name('htmxdetails');


    //  Admin
    Route::get('/admin/users',[UserController::class, 'index'])->name('users');
//    Route::get('/admin/manage',[PanelController::class, 'manage'])->name('other');
    Route::get('/admin/manage',[PanelController::class, 'index'])->name('htmx.other');
    Route::post('/admin/company/create',[CompanyController::class, 'store'])->name('company.create');
    Route::post('/admin/company/update',[CompanyController::class, 'update'])->name('company.update');
    Route::post('/admin/product/create',[ProductController::class, 'store'])->name('product.create');
    Route::post('/admin/product/update',[ProductController::class, 'update'])->name('product.update');
    Route::post('/admin/status/create',[StatusController::class, 'store'])->name('status.create');
    Route::post('/admin/status/update',[StatusController::class, 'update'])->name('status.update');
    Route::post('/admin/source/create',[SourceController::class, 'store'])->name('source.create');
    Route::post('/admin/source/update',[SourceController::class, 'update'])->name('source.update');
    Route::post('/admin/user/create',[UserController::class, 'store'])->name('user.create');
    Route::get('/admin/user/applications/{id}',[UserController::class, 'userapps'])->name('user.apps');
    Route::post('/admin/user/password/change',[UserController::class, 'changeUserPassword'])->name('user.password.change');




    // App
    Route::post('app/create',[ApplicationController::class, 'store'])->name('app.create');
    Route::get('app/edit/{id}',[ApplicationController::class, 'edit'])->name('app.edit');
    Route::post('app/update',[ApplicationController::class, 'update'])->name('app.update');
    Route::get('app/details/{id}',[ApplicationController::class, 'details'])->name('app.details');

    // clients
    Route::get('app/clients/existing',[ClientController::class, 'existingIndex'])->name('existing.clients');
    Route::get('app/clients/potential',[ClientController::class, 'potentialIndex'])->name('potential.clients');
    Route::post('app/clients/potential/create',[ClientController::class, 'createPotential'])->name('potential.clients.create');
    Route::post('app/clients/potential/update',[ClientController::class, 'updatePotential'])->name('potential.clients.update');

    // changepassword
    Route::post('password/change',[UserController::class, 'changePassword'])->name('password.change');

    // SSE
    Route::get('/notifications/sse', [NotificationController::class, 'sse'])->name('sse');
    Route::get('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark.as.read');
    Route::get('/htmx/notifications', [NotificationController::class, 'showheader'])->name('htmx.notifications');

    // log viewer
    Route::get('/log-viewer?file=7d22837e-changes.log&query=+{query}', [LogViewerController::class, 'show'])->name('customlogviewer');

});

// Uploads
Route::get('/uploads',[UploadController::class, 'index'])->name('upload.index');
Route::post('/uploads/cars',[UploadController::class, 'carUpload'])->name('upload.cars');
Route::get('randuser',function(){
    return User::inRandomOrder()->first()->id;

});

Route::get('session',function(){

    Session::forget(['request_counter2']);

});



Route::get('notifications',function(){

    $notification = new Notification();
    $notification->application_id =25;
    $notification->user_id        = auth()->user()->id;
    $notification->type           = 'დაემატა ახალი კომენტარი';
    $notification->save();

//    return view('htmx.htmxnotifications');

});


// ============== Fortify===============

