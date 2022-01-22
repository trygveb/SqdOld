<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchemaController;
use App\Http\Controllers\UnixController;
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
Route::group(  // Comment out this when running tests
   ['prefix' => LaravelLocalization::setLocale(),
      'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

// Registration routes//////////////////////////////////////////////////////////
      // Show the registration form
      Route::name('showRegisterForm')->get('registration/{application}', [CustomAuthController::class, 'showRegisterForm'])->middleware('guest');

      // Handle the registration request
      Route::name('handleRegistration')->post('custom-registration', [CustomAuthController::class, 'handleRegistration']);

      //Show the notice which tells the user to open the mail with a link for email verification
      Route::name('verification.notice')->get('/email/showVerifyEmail/{application}', [CustomAuthController::class, 'showVerifyEmail']);

      
      Route::name('verification.send')->post('/email/verification-notification', [CustomAuthController::class, 'sendEmailVerificationNotification'])
        ->middleware(['auth', 'throttle:5,1']);
        
      // Handle the request for email verification sent from the email sent to the user. 
      // NOTE! Do not change the name of this route, as it is triggered by the event(new Registered($user))
      Route::name('verification.verify')->get('/email/verify/{id}/{hash}',  [CustomAuthController::class, 'handleEmailVerification'])
      ->middleware(['auth', 'signed']);
      
// Forgotten Password routes /////////////////////////////////////////////////////
      
    // Show the view with the password reset link request form:
      Route::name('showForgotPasswordForm')->get('/forgot-password/{application}', [CustomAuthController::class, 'showForgotPasswordForm'])
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
      Route::name('showLoginForm')->get('login/{application}', [CustomAuthController::class, 'showLoginForm'])->middleware('guest');
      // Handle login request
      Route::name('login.custom')->post('custom-login', [CustomAuthController::class, 'customLogin'])->middleware(env('LOGIN_THROTTLE','throttle:5,1'));
      // Logout user
      Route::name('signout')->get('signout', [CustomAuthController::class, 'signOut'])->middleware('auth');
      
// Home and welcome routes //////////////////////////////////////////////////////

      // For sqd.se, NOT logged in, application not selected
      Route::name('home')->get('/', [HomeController::class, 'home']); 
      
      

// Calls routes ///////////////////////////////////////////////////////////////
   Route::name('calls.')->group(function () {
      // Show application welcome view  
      Route::name('home')->get('/sdCalls/home', [HomeController::class, 'callsHome']);
      // Show application welcome view for guests, or authenticated but not verified (Prompt for login or registration)
      Route::name('guest')->get('sdCalls', [HomeController::class, 'callsGuest']);
   });

// Schema routes ///////////////////////////////////////////////////////////////
   Route::name('schedule.')->group(function () {
      // Show application home/welcome view  
      Route::name('home')->get('/schedule/home', [HomeController::class, 'schemaHome']);
      // Show the schema
      Route::name('index')->get('/schedule/show/{scheduleId?}', [SchemaController::class, 'index']);
      //Show edit view for one user for  attendance update
      Route::name('showEdit')->get('/schedule/edit/{schedule}',[SchemaController::class, 'showViewEdit']);
      // Update attendance (for one user)
      Route::name('updateAttendance')->post('/schedule/updateAttendance', [SchemaController::class,'updateAttendance']);
   // Show view AdminComments
      Route::name('showComments')->get('/admin/comments/{scheduleId}', [SchemaController::class,'showViewAdminComments']);
   // Show add/remove members view
      Route::name('showMembers')->get('/admin/members/{scheduleId}', [SchemaController::class, 'showViewMembers']);
   // Add existing users to a schedule
      Route::name('addMember')->post('/admin/addMember', [SchemaController::class, 'addMember']);
   // Update admin status or rRemove member from a schedule
      Route::name('updateMember')->post('/admin/updateMember', [SchemaController::class, 'updateMember']);
   // Show register new user form
      Route::name('showRegisterUser')->get('/admin/showRegisterUser/{scheduleId}', [SchemaController::class, 'showRegisterUser']);

   // Update comments
      Route::name('updateComments')->post('/schedule/updateComments', [SchemaController::class, 'updateComments']);
   // Show add/remove dates view
      Route::name('showAddRemoveDates')->get('/admin/AddRemoveDates/{scheduleId}', [SchemaController::class, 'showViewAddRemoveDates']);
   // Add dates
      Route::name('addDates')->post('/admin/addDates', [SchemaController::class, 'addDates']);
   // Remove dates
      Route::name('removeDates')->post('/admin.removeDates', [SchemaController::class, 'removeDates']);

      
   });
});   // Comment out this when running tests

// Routes not needing localization /////////////////////////////////////////////
Route::get('/switchLocale', [HomeController::class, 'switchLocale'])->name('switchLocale');


// Routes in dev environment only ///////////////////////////////////////////////
Route::domain('schema.dev.sqd.se')->group(function () {
   Route::get('/unix/home', [UnixController::class,'index'])->middleware('auth');
   Route::post('/unix/createConfigFile', [UnixController::class, 'createConfigFile'])->name('createConfigFile');   
   Route::get('/unix/createAllConfigFile', [UnixController::class, 'createAllConfigFiles'])->name('createAllConfigFiles');   
});

//  Route::get('/email/verify', function () { return view('auth.verify-email');
//})->middleware('auth')->name('verification.notice');

// Test routes,  no localization ///////////////////////////////////////////////
//Route::name('test.')->group(function () {
//   Route::name('showRegisterForm')->get('registration/{application}', [CustomAuthController::class, 'showRegisterForm'])->middleware('guest');
//});
////////////////////////////////////////////////////////////////////////////////
