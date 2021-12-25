<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

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

         if (Auth::user()->verified != 1) {
            return redirect()
                            ->route('login',['app' =>'calls'])
                            ->with('danger', 'You didnt confirm your email yet. ');
         }
         return redirect()->intended($app . '/home')
                         ->withSuccess('Signed in');
      }

      return redirect("login/schema")->withSuccess('Sorry, login details are not valid');
   }

   public function registration() {
      return view('auth.registration');
   }

   public function customRegistration(Request $request) {

      $request->validate([
          'name' => 'required',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:6',
      ]);

      $data = $request->all();
      $user = $this->create($data);

      event(new Registered($user));

//        Auth::login($user);
      //return redirect(route("welcome"))->withSuccess( __('You have signed-in') );
      return redirect(route('verification.notice'));
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

   public function showVerifyEmail() {
      return view('auth.verify-email');
   }

   public function signOut() {
      Session::flush();
      Auth::logout();

      return Redirect('/');
   }

}
