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
//Route::group(
//   ['prefix' => LaravelLocalization::setLocale(),
//      'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

// Registration routes//////////////////////////////////////////////////////////
      // Show the registration form
      Route::name('showRegisterForm')->get('registration/{application}', [CustomAuthController::class, 'showRegisterForm'])->middleware('guest');

      // Handle the registration form
      Route::name('register.custom')->post('custom-registration', [CustomAuthController::class, 'customRegistration']);

      //Show the notice which tells the user to open the mail With a link fot email verification
      Route::name('verification.notice')->get('/email/showVerifyEmail/{application}', [CustomAuthController::class, 'showVerifyEmail']);

      
      Route::name('verification.send')->post('/email/verification-notification', [CustomAuthController::class, 'sendEmailVerificationNotification'])
        ->middleware(['auth', 'throttle:6,1']);
        
      Route::name('verification.verify')->get('/email/verify/{id}/{hash}',  [CustomAuthController::class, 'handleEmailVerification'])
      ->middleware(['auth', 'signed']);
      
// Forgoten Password routes /////////////////////////////////////////////////////
      
    // Show the view with the password reset link request form:
      Route::name('password.request')->get('/forgot-password/{application}', [CustomAuthController::class, 'showForgotPasswordForm'])
              ->middleware('guest');

      // Handle the request for sending the forgotten password reset link
      Route::name('password.email')->post('/forgot-password', [CustomAuthController::class, 'sendPasswordResetLink'])
              ->middleware('guest');

      // Display the reset password form that is displayed when the user clicks the reset password link
      Route::name('password.reset')->get('/reset-password/{token}', [CustomAuthController::class, 'showResetPasswordForm'])
              ->middleware('guest');
      
      // Handle the password reset form submission
      Route::name('password.update')->post('/reset-password', [CustomAuthController::class, 'handleThePasswordResetFormSubmission'])
         ->middleware('guest');
      
// Login/logout routes //////////////////////////////////////////////////////////
      // Show login form
      Route::name('login')->get('login/{application}', [CustomAuthController::class, 'showLoginForm'])->middleware('guest');
      // Handle login request
      Route::name('login.custom')->post('custom-login', [CustomAuthController::class, 'customLogin'])->middleware(env('LOGIN_THROTTLE','throttle:5,1'));
      // Logout user
      Route::name('signout')->get('signout', [CustomAuthController::class, 'signOut'])->middleware('auth');
      
// Home and welcome routes //////////////////////////////////////////////////////

      // For sqd.se, NOT logged in, application not selected
      Route::name('home')->get('/', [HomeController::class, 'home']); 
      
      // Show application welcome view for guests, or authenticated but not verified (Prompt for login or registration)
      Route::name('sdCalls.guest')->get('sdCalls', [HomeController::class, 'callsGuest']);
      Route::name('sdSchema.guest')->get('sdSchema', [HomeController::class, 'schemaGuest']);
      
      // Show application welcome view for authenticated and verified users 
      Route::name('sdCalls.home')->get('/sdCalls/home', [HomeController::class, 'callsHome'])->middleware('verified');
      Route::name('sdSchema.home')->get('/sdSchema/home', [HomeController::class, 'schemaHome'])->middleware('verified');


//});

// Routes not needing localization
Route::get('/switchLocale', [HomeController::class, 'switchLocale'])->name('switchLocale');

//  Route::get('/email/verify', function () { return view('auth.verify-email');
//})->middleware('auth')->name('verification.notice');

// Test routes,  no localization ///////////////////////////////////////////////
//Route::name('test.')->group(function () {
//   Route::name('showRegisterForm')->get('registration/{application}', [CustomAuthController::class, 'showRegisterForm'])->middleware('guest');
//});
////////////////////////////////////////////////////////////////////////////////
