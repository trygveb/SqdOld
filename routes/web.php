<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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

           Route::get('login/{app}', [CustomAuthController::class, 'showLoginForm'])->name('login');
           Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
           Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
           Route::get('welcome', [HomeController::class, 'welcome'])->name('welcome')->middleware('auth'); // For sqd.se, logged in, application not selected
           Route::get('/email/showVerifyEmail}', [CustomAuthController::class, 'showVerifyEmail'])->name('verification.notice');

           Route::get('/', [HomeController::class, 'home'])->name('home'); // For sqd.se, NOT logged in, application not selected
           Route::get('calls', [HomeController::class, 'callsGuest'])->name('calls.guest');
           Route::get('schema', [HomeController::class, 'schemaGuest'])->name('schema.guest');
           Route::get('/calls/home', [HomeController::class, 'callsHome'])->name('calls.home')->middleware('verified');
           Route::get('/schema/home', [HomeController::class, 'schemaHome'])->name('schema.home')->middleware('verified');
           Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');

         // Show the form  for forgotten password
           Route::get('/forgot-password', [CustomAuthController::class, 'showForgotPasswordForm'])
                   ->middleware('guest')
                   ->name('password.request');

           // Handle the request for sending the forgotten password reset link
           Route::post('sendPasswordResetLink', [CustomAuthController::class, 'sendPasswordResetLink'])
                   ->middleware('guest')
                   ->name('password.email');

           // Display the reset password form that is displayed when the user clicks
           //  the reset password link
           Route::get('/reset-password/{token}', function ($token) {
              return view('auth.reset-password', ['token' => $token]);
           })->middleware('guest')->name('password.reset');

           // Handle the password reset form submission
           Route::post('/reset-password', function (Request $request) {
              $request->validate([
                  'token' => 'required',
                  'email' => 'required|email',
                  'password' => 'required|min:8|confirmed',
              ]);

              $status = Password::reset(
                              $request->only('email', 'password', 'password_confirmation', 'token'),
                              function ($user, $password) {
                                 $user->forceFill([
                                     'password' => Hash::make($password)
                                 ])->setRememberToken(Str::random(60));

                                 $user->save();

                                 event(new PasswordReset($user));
                              }
              );

              return $status === Password::PASSWORD_RESET ? redirect()->route('login')->with('status', __($status)) : back()->withErrors(['email' => [__($status)]]);
           })->middleware('guest')->name('password.update');
//   Route::post('/email/verification-notification', [CustomAuthController::class, 'sendEmailVerificationNotification'])
//   ->middleware(['auth', 'throttle:6,1'])
//   ->name('verification.send');
        }
);

Route::post('/email/verification-notification', [CustomAuthController::class, 'sendEmailVerificationNotification'])
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');

Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('/switchLocale', [HomeController::class, 'switchLocale'])->name('switchLocale');

//  Route::get('/email/verify', function () { return view('auth.verify-email');
//})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
      $request->fulfill();
      return redirect(route('home'));
   })
   ->middleware(['auth', 'signed'])
   ->name('verification.verify');

