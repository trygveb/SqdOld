<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Password;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class CustomAuthController extends Controller {

   public function showLoginForm($app) {
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
         if (!Auth::user()->hasVerifiedEmail()) {

            // Auth::logout();
            return redirect()
                            ->route('verification.notice', ['app' => $app])
                            ->with('danger', __('Please confirm your email before logging in.'));
         }
         return redirect()->intended($app . '/home')
                         ->withSuccess('Signed in');
      }

      return redirect(route('login', ['app' => $app]))->withSuccess(__('Sorry, login details are not valid'));
   }

   public function customRegistration(Request $request) {

      $request->validate([
          'name' => 'required',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:6',
      ]);

      $data = $request->all();
      $user = $this->create($data);
      // $user->application = $request->application;
      App::setLocale(LaravelLocalization::getCurrentLocale());
      event(new Registered($user));
      Auth::login($user);
      //return redirect(route("welcome"))->withSuccess( __('You have signed-in') );
      return redirect(route('verification.notice', []));
   }

   public function create(array $data) {
      return User::create([
                  'name' => $data['name'],
                  'email' => $data['email'],
                  'password' => Hash::make($data['password'])
      ]);
   }

   public function handleThePasswordResetFormSubmission(Request $request) {

      $request->validate([
          'token' => 'required',
          'email' => 'required|email',
          'password' => 'required|min:6|confirmed',
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

      //return $status === Password::PASSWORD_RESET ? redirect()->route('login')->with('status', __($status)) : back()->withErrors(['email' => [__($status)]]);
      return $status === Password::PASSWORD_RESET ?  back()->with('status', __($status)) : back()->withErrors(['email' => [__($status)]]);
      }

   public function sendPasswordResetLink(Request $request) {
//      dd('frontend_url='.config('app.frontend_url'));
      $request->validate(['email' => 'required|email']);

//      $user = new User();
//      $user->application = $request->application;
//
//      $request->user = $user;
      $status = Password::sendResetLink($request->only('email'));
      return $status === Password::RESET_LINK_SENT ?
              back()->with(['status' => __($status)]) :
              back()->withErrors(['email' => __($status)]);

//      return back()->with('message', 'Verification link sent!');
   }

   // Show the view with the password reset link request form:
   public function showForgotPasswordForm($app) {
      
      return view('auth.forgot-password')->with('application', $app);
   }

   public function registration() {
      return view('auth.registration');
      ;
   }

   public function showVerifyEmail() {
      return view('auth.verify-email-notice'); //->with('application', $app);
   }

   // User has asked for a new e-mail verification mail.
   public function sendEmailVerificationNotification(Request $request) {
      $user = $request->user();
      //$user->application = $request->application;
      $user->sendEmailVerificationNotification();
      return back()->with('link_sent', __('Verification link sent!'));
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
