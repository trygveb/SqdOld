<?php

namespace App\Classes;

use App\Models\Schedule\V_MemberSchedule;
use App\Models\Schedule\MemberSchedule;
use App\Models\Schedule\MemberScheduleDate;


class UserManagerX {
    /**
    * Add user Adam to both schedules
    * Add all other users except Kain to one schedule.
    * @param type $users
    * @param type $schedules
    */
 private function addUserToScheduleDates($user, $scheduleDates) {

      foreach ($scheduleDates as $scheduleDate) {
         $scheduleId = $scheduleDate->schedule_id;
         $groupSize = MemberSchedule::where('schedule_id', $scheduleId)
                         ->where('user_id', $user->id)
                         ->first()
                 ->group_size;
         
         addOneUserToOneScheduleDate($scheduleDate, $user, $groupSize);
      }
   }


   private static function addOneUserToOneSchedule($user, $schedule) {
//      printf("Adding user %d to schedule %s\n", $user->id, $schedule->id);
      $memberSchedule = new MemberSchedule;
      $memberSchedule->user_id = $user->id;
      $memberSchedule->schedule_id = $schedule->id;
      $memberSchedule->save();
   }

   private static function addOneUserToOneScheduleDate($scheduleDate, $user, $groupSize) {
//      printf("Adding user %d to scheduleDate %s\n", $user->id, $scheduleDate->schedule_date);
      $memberScheduleDate = new MemberScheduleDate;
      $memberScheduleDate->user_id = $user->id;
      $memberScheduleDate->schedule_date_id = $scheduleDate->id;
      $ms1 = rand(12345, 999999);
//      echo "$ms1\n";
      $status = $ms1 % 5;
      if ($groupSize == 1 && $status == 2) {
         $status = 1;
      }
      if ($status == 0 && rand(0, 10) > 4) {
         $status = 1;
      }
      if ($status == 4 && rand(0, 10) > 3) {
         $status = 1;
      }
      $memberScheduleDate->status = $status;
      $memberScheduleDate->save();
   }


}