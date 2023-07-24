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
$dashboard =  new Dashboard();
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


Route::get('/dashboard',function() use ($home){
    return $home->dashboard();
})->name('dashboard');

/***
 * -----------------------------
 * Dashboard
 * -----------------------------
 */
Route::get('/logout',function() use ($dashboard){
return $dashboard->logout();
});

Route::get('/dashboard/{name}',function(Request $request) use ($dashboard){
    return $dashboard->dashboard($request->name);
});