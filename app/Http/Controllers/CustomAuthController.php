<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\App;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CustomAuthController extends Controller {

   public function index($app) {
//        return view('auth.login');
      return view('auth.login', ['app' => $app]);
   }

   public function customLogin(Request $request) {
      $request->validate([
          'email' => 'required',
          'password' => 'required',
      ]);
      $app = $request->application;

      $credentials = $request->only('email', 'password');
      if (Auth::attempt($credentials)) {
         if (! Auth::user()->hasVerifiedEmail()) {
            
            // Auth::logout();
            return redirect()
                            ->route('verification.notice', ['app' => $app])
                            ->with('danger', 'Please confirm your email before logging in. ');
         }
         return redirect()->intended($app . '/home')
                         ->withSuccess('Signed in');
      }

      return redirect(route('login', ['app' => $app]))->withSuccess('Sorry, login details are not valid');
   }

   public function registration($app) {
      return view('auth.registration')->with('application', $app);;
   }

   public function customRegistration(Request $request) {

      $request->validate([
          'name' => 'required',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:6',
      ]);

      $data = $request->all();
      $user = $this->create($data);
      $user->application=$request->application;
      App::setLocale(LaravelLocalization::getCurrentLocale());
      event(new Registered($user));
        Auth::login($user);
      //return redirect(route("welcome"))->withSuccess( __('You have signed-in') );
      return redirect(route('verification.notice', ['app' => $request->application]));
   }

   public function create(array $data) {
      return User::create([
                  'name' => $data['name'],
                  'email' => $data['email'],
                  'password' => Hash::make($data['password'])
      ]);
   }

   public function dashboard() {
      if (Auth::check()) {
         return view('dashboard');
      }

      return redirect("login")->withSuccess('You are not allowed to access');
   }

   public function showVerifyEmail($app) {
      return view('auth.verify-email-notice')->with('application', $app);
   }

   // User has asked for a new e-mail verification mail.
   public function sendEmailVerificationNotification(Request $request) {
      
      $user->application= $request->application;
      $user->sendEmailVerificationNotification();
      return back()->with('message', 'Verification link sent!');
   }

//   public function verificationVerify(EmailVerificationRequest $request) {
////   public function verificationVerify($id, $hash) {
////      dd("verificationVerify hash=".$hash);
//      $request->fulfill();
//      return redirect('/home');
//   }

   public function signOut() {
      Session::flush();
      Auth::logout();

      return Redirect('/');
   }

}
