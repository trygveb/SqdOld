<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
//use Illuminate\Auth\Events\PasswordReset;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Password;
//use Illuminate\Support\Str;

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
      'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

      Route::name('showRegisterForm')->get('registration/{application}', [CustomAuthController::class, 'showRegisterForm']);
      Route::name('login')->get('login/{application}', [CustomAuthController::class, 'showLoginForm']);
      Route::name('signout')->get('signout', [CustomAuthController::class, 'signOut']);
      
      Route::get('welcome', [HomeController::class, 'welcome'])->name('welcome')->middleware('auth'); // For sqd.se, logged in, application not selected
      Route::get('/email/showVerifyEmail/{application}', [CustomAuthController::class, 'showVerifyEmail'])->name('verification.notice');

      Route::get('/', [HomeController::class, 'home'])->name('home'); // For sqd.se, NOT logged in, application not selected
      Route::get('sdCalls', [HomeController::class, 'callsGuest'])->name('sdCalls.guest');
      Route::get('sdSchema', [HomeController::class, 'schemaGuest'])->name('sdSchema.guest');
      Route::get('/sdCalls/home', [HomeController::class, 'callsHome'])->name('sdCalls.home')->middleware('verified');
      Route::get('/sdSchema/home', [HomeController::class, 'schemaHome'])->name('sdSchema.home')->middleware('verified');
      Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');

    // Show the view with the password reset link request form:
      Route::get('/forgot-password/{application}', [CustomAuthController::class, 'showForgotPasswordForm'])
              ->middleware('guest')
              ->name('password.request');

      // Handle the request for sending the forgotten password reset link
      Route::post('/forgot-password', [CustomAuthController::class, 'sendPasswordResetLink'])
              ->middleware('guest')
              ->name('password.email');

      // Display the reset password form that is displayed when the user clicks
      //  the reset password link
      Route::get('/reset-password/{token}', function ($token) {
         return view('auth.reset-password', ['token' => $token]);
      })->middleware('guest')->name('password.reset');

      // Handle the password reset form submission
      Route::post('/reset-password', [CustomAuthController::class, 'handleThePasswordResetFormSubmission'])
         ->middleware('guest')
         ->name('password.update');
      
      Route::post('/email/verification-notification', [CustomAuthController::class, 'sendEmailVerificationNotification'])
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');
        
      Route::get('/email/verify/{id}/{hash}',  [CustomAuthController::class, 'handleEmailVerification'])
      ->middleware(['auth', 'signed'])
      ->name('verification.verify');
      
      Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');

});


Route::get('/switchLocale', [HomeController::class, 'switchLocale'])->name('switchLocale');
Route::name('showRegisterFormTest')->get('registration/{application}', [CustomAuthController::class, 'showRegisterForm']);
//  Route::get('/email/verify', function () { return view('auth.verify-email');
//})->middleware('auth')->name('verification.notice');



