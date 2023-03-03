<?php

namespace App\Classes;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule\V_MemberSchedule;

class Utility {
   /**
    * 
    * @param type $scheduleId
    * @return int =1 if user is ScheduleAdmin for the given schedule, else zero.
    */
    public static function getAdminForSchedule($scheduleId) {
        $adminForSchedule=0;
        if (Auth::check()) {
            $adminForSchedule = V_MemberSchedule::where('schedule_id', $scheduleId)
                ->where('user_id', Auth::user()->id)
                ->pluck('admin')
                ->first();
        }
        return $adminForSchedule;
     }
  
}
