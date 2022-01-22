<?php

namespace App\Http\Controllers;

use App\Models\Schedule\V_MemberSchedule;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\App;

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
      $fullUrl = request()->fullUrl();
      if (str_contains($fullUrl, 'schema')) {
         return $this->schemaHome();
      } elseif (str_contains($fullUrl, 'calls')) {
         return $this->callsHome();
      }
      return view('home')->with('extra', $fullUrl);
   }

   /**
    * Show schedule welcome view for guests
    * @return view
    */
   public function schemaHome() {
      if (Auth::check()) {
         if (Auth::user()->hasVerifiedEmail()) {

            //dd('schemaGuest, auth');
            $vMemberSchedules = V_MemberSchedule::where('user_id', Auth::user()->id)->get();
            $count = $vMemberSchedules->count();
            if ($count == 1) {
               return redirect(route('schedule.index', ['scheduleId' => $vMemberSchedules[0]->schedule_id]));
            } else {
               return view('schedule.welcome', [
                   'mySchedulesCount' => $count,
                   'vMemberSchedules' => $vMemberSchedules
               ]);
            }
         } else {
            return view('auth.verify-email-notice')
               ->with('emailVerified','NO')
               ->with('application', 'schedule');
         }
      }
         return view('schedule.welcome')->with('mySchedulesCount' , 0);
//      abort(403, 'Unauthorized action.');
   }

   /**
    * Show schedule welcome view for authenticated and verified users
    * @return view
    */
   public function schemaHomeOld() {
      $count = 0;
      if (Auth::check()) {
//         $myMemberSchedules = MemberSchedule::where('user_id', Auth::user()->id)->get();
//         $count = $myMemberSchedules->count();
//         if ($count == 1) {
//            return redirect(route('schedule.index', ['scheduleId' => $myMemberSchedules[0]->schedule_id]));
//         } else {
         return view('schedule.welcome', [
             'mySchedulesCount' => $count,
         ]);
      }
//      } else {
//         abort(403, 'Unauthorized action.');
//      }
   }

   public function switchLocale() {
      if (config('app.locale') == 'en') {
         config(['app.locale' => 'sv']);
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
