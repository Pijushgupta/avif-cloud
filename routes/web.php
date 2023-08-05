<?php

use App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
$home = new Home();

Route::get('/', function () use ($home) {

    return $home->index();
})->name('loginFrom');

Route::post('/',function(Request $request) use ($home){

    return $home->handleLogin($request);
})->name('login');

Route::get('/register',function() use ($home){

    return $home->register();
})->name('registerForm');

Route::post('/register',function(Request $request) use ($home){

    return $home->handleRegistration($request);
})->name('register');



/***
 * -----------------------------
 * Dashboard
 * Protected Routes
 * -----------------------------
 */
Route::middleware('auth')->group(function(){

    $dashboard =  new Dashboard();

    Route::get('/dashboard', function() use ($dashboard){
        return $dashboard->dashboard();
    });
    Route::get('/logout',function() use ($dashboard){
        return $dashboard->logout();
    });

    Route::get('/dashboard/create',function() use($dashboard){
        return $dashboard->create();
    })->name('create');

    Route::get('/dashboard/checkout/{id}',function($id) use($dashboard){

        return $dashboard->checkout($id);

    })->where('id', '[0-9]+');

    Route::get('/dashboard/checkout/paymentstatus/', function(Request $request) {
        if(!$request->query('payment_intent')) return;
        return redirect()->route('final-msg',$request->query('payment_intent')) ;
    });

    Route::get('/dashboard/checkout/status/{slug}',function($slug) use($dashboard){

        return $dashboard->PaymentStatus($slug);
    })->name('final-msg');

    Route::post('/dashboard/checkout/addaddress',function(Request $request) use($dashboard){
        return $dashboard->addAddress($request);
    });
});








