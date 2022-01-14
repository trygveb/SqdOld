<?php

namespace App\Http\Controllers;

use App\Models\MemberTraining;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class HomeController extends Controller {

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct() {
      //$this->middleware('auth');
   }


   /**
    * Show sdCalls welcome view for guests
    * @return view
    */
   public function callsGuest() {
      return view('sdCalls.welcome');
   }

   /**
    * Show sdCalls welcome view for authenticated and verified users
    * @return view
    */
   public function callsHome() {
      return view('sdCalls.welcome');
   }

   /**
    *  For sqd.se, NOT logged in, application not selected
    * @return view
    */
   public function home() {
    $origin = array("sqd.se", "schema.sqd.se", "test.sqd.se", "schema.test.sqd.se", "calls.sqd.se", "calls.test.sqd.se", "192.168.10.10");
    $domain = parse_url(request()->root())['host'];
    dd('fullUrl='.request()->fullUrl());
     if (in_array($domain, $origin)) {
        if (str_contains(request(),'192.168.10.10')) {
            return view('home')->with('path', request()->path());
        } 
        else if ($domain === 'calls.test.sqd.se') {
            return $this.callsGuest();
        } 
        else if ($domain === 'schema.test.sqd.se') {
            return $this.schemaGuest();
        } else {
           
        }
    } else{ 
        return view('unauthorized')->with('domain',$domain);
    }

   }

   /**
    * Show sdSchema welcome view for guests
    * @return view
    */
   public function schemaGuest() {
      return view('sdSchema.welcome');
   }

   /**
    * Show sdSchema welcome view for authenticated and verified users
    * @return view
    */
   public function schemaHome() {
      $count = 0;
      if (Auth::check()) {
//         $myMemberTrainings = MemberTraining::where('user_id', Auth::user()->id)->get();
//         $count = $myMemberTrainings->count();
//         if ($count == 1) {
//            return redirect(route('schema.index', ['trainingId' => $myMemberTrainings[0]->training_id]));
//         } else {
         return view('sdSchema.welcome', [
             'myTrainingsCount' => $count,
         ]);
      }
//      } else {
//         abort(403, 'Unauthorized action.');
//      }
   }

   public function switchLocale() {
      if (config('app.locale') == 'en') {
         config(['app.locale' => 'se']);
      } else {
         config(['app.locale' => 'en']);
      }
      return redirect()->back()->withSuccess('You have switched to ' . config('app.locale'));
      ;
   }

   public function welcome() {
//      return view('welcome', ['showAuthenticationLinks' => false]);
      return view('welcome');
   }

}
