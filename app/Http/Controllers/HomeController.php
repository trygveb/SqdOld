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
   public function callsGuest() {
      return view('sdCalls.welcome', ['showAuthenticationLinks' => true]);
   }

   public function callsHome() {
      return view('sdCalls.welcome', ['showAuthenticationLinks' => true]);
   }

   public function home() {
      return view('home', ['showAuthenticationLinks' => false]);
   
    }

   public function schemaGuest() {
      return view('sdSchema.welcome', ['showAuthenticationLinks' => true]);
   }

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
      return redirect()->back()->withSuccess('You have switched to '.config('app.locale'));;
   }
   
   public function welcome() {
      return view('welcome', ['showAuthenticationLinks' => false]);
      
   }
}
