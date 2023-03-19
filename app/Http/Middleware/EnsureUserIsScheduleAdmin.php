<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Classes\Utility;

class EnsureUserIsScheduleAdmin {

   /**
    * Check that user is ScheduleAdmin (=has admin authority on the schedule) or root 
    * The current scheduleId must be the last element in the current url
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
   public function handle(Request $request, Closure $next) {
      if (Auth::check()) {
         $user = $request->user();
         if ($user->isScheduleAdministrator() || $user->isRoot()) {
            return $next($request);  
         }
         $adminForSchedule = 0;
         $url = url()->full();
         if (str_contains($url, '/admin/')) {
//            dd($url);
            $atoms = explode('/', $url);
            $scheduleId = $atoms[count($atoms) - 1];
            if (!is_numeric($scheduleId)) {
               $scheduleId= $data["scheduleId"] ?? null; 
               if (is_null($scheduleId)) {
                return redirect()->back();
               }
               $scheduleId = $data["scheduleId"];               
            }
            $adminForSchedule= Utility::getAdminForSchedule($scheduleId);
               // $adminForSchedule = V_MemberSchedule::where('schedule_id', $scheduleId)
               //      ->where('user_id', Auth::user()->id)
               //      ->pluck('admin')
               //      ->first();
         }
         if ($adminForSchedule > 0) {
            return $next($request);  // User has "schema" privileges 
         }
      }
      // No authority, just go back with no message
      return redirect()->back();

   }

}
