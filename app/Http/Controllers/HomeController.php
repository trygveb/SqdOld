<?php

namespace App\Http\Controllers;

use App\Models\MemberTraining;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct() {
      //$this->middleware('auth');
   }

   public function schemaGuest() {
      return view('schema.welcome', ['showAuthenticationLinks' => true]);
   }
   public function callsGuest() {
      return view('calls.welcome', ['showAuthenticationLinks' => true]);
   }
   public function callsHome() {
      return view('calls.welcome', ['showAuthenticationLinks' => true]);
   }

   public function schemaHome() {
      $count = 0;
      if (Auth::check()) {
         $myMemberTrainings = MemberTraining::where('user_id', Auth::user()->id)->get();
         $count = $myMemberTrainings->count();
         if ($count == 1) {
            return redirect(route('schema.index', ['trainingId' => $myMemberTrainings[0]->training_id]));
         } else {
            return view('welcome', [
                'myTrainingsCount' => $count,
            ]);
         }
      } else {
         abort(403, 'Unauthorized action.');
      }
   }

   public function home() {
   
      return view('home', [
      ]);
   
    }
}
