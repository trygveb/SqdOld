<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
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
Route::group(
   ['prefix' => LaravelLocalization::setLocale(),
   'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
//   Route::get('/', function () {
//       return view('welcome');
//   });

//   Route::get('/dashboard', function () {
//       return view('dashboard');
//   })->middleware(['auth'])->name('dashboard');

   //require __DIR__.'/auth.php';

   Route::get('login/{app}', [CustomAuthController::class, 'index'])->name('login');
   Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
   Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
   Route::get('welcome', [HomeController::class, 'welcome'])->name('welcome')->middleware('auth'); // For sqd.se, logged in, application not selected
   Route::get('/email/verify', [CustomAuthController::class, 'showVerifyEmail'])->name('verification.notice');

   Route::get('/', [HomeController::class, 'home'])->name('home'); // For sqd.se, NOT logged in, application not selected
   Route::get('calls', [HomeController::class, 'callsGuest'])->name('calls.guest');
   Route::get('schema', [HomeController::class, 'schemaGuest'])->name('schema.guest');
   Route::get('/calls/home', [HomeController::class, 'callsHome'])->name('calls.home')->middleware('auth');
   Route::get('/schema/home', [HomeController::class, 'schemaHome'])->name('schema.home')->middleware('auth');

}
);
   Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
   Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
   Route::get('/switchLocale', [HomeController::class, 'switchLocale'])->name('switchLocale');

//  Route::get('/email/verify', function () { return view('auth.verify-email');
//})->middleware('auth')->name('verification.notice');


//Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//    $request->fulfill();
//    return redirect('/home');
//})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify/{id}/{hash}', [CustomAuthController::class, 'verificationVerify'])
   ->middleware(['auth', 'signed'])
   ->name('verification.verify');

Route::post('/email/verification-notification', [CustomAuthController::class, 'sendEmailVerificationNotification'])
   ->middleware(['auth', 'throttle:6,1'])
   ->name('verification.send');