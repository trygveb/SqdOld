<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//require __DIR__.'/auth.php';

Route::get('login/{app}', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('calls', [HomeController::class, 'callsGuest'])->name('calls.guest');
Route::get('schema', [HomeController::class, 'schemaGuest'])->name('schema.guest');
Route::get('/calls/home', [HomeController::class, 'callsHome'])->name('calls.home')->middleware('auth');
Route::get('/schema/home', [HomeController::class, 'schemaHome'])->name('schema.home')->middleware('auth');

//Route::get('/', 'HomeController@home')->name('home');
//Route::get('/calls', 'HomeController@callsGuest')->name('calls.guest');
//Route::get('/schema', 'HomeController@schemaGuest')->name('schema.guest');
//Route::get('/calls/home', 'HomeController@callsHome')->name('calls.home')->middleware('auth');
//Route::get('/schema/home', 'HomeController@schemaHome')->name('schema.home')->middleware('auth');

