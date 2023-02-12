<?php

namespace App\Models\Schedule;

use App\Models\Schedule\MemberSchedule;
use App\Models\Schedule\MemberScheduleDate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Schedule extends Model {

   protected $connection = 'schedule';
   protected $table = 'schedule';

   public function scheduleDates() {
      return $this->hasMany(ScheduleDate::class);
   }

   public function addMember($userId, $groupSize, $nameInSchema) {

      DB::beginTransaction();
      try {
         $memberSchedule = new MemberSchedule();
         $memberSchedule->user_id = $userId;
         $memberSchedule->group_size = $groupSize;
         $memberSchedule->schedule_id = $this->id;
         $memberSchedule->name_in_schema= $nameInSchema;
         $memberSchedule->save();
         foreach ($this->scheduleDates as $scheduleDate) {
            $memberScheduleDate = new MemberScheduleDate();
            $memberScheduleDate->user_id = $userId;
            $memberScheduleDate->schedule_date_id = $scheduleDate->id;
            $memberScheduleDate->save();
         }
      } catch (\Illuminate\Database\QueryException $ex) {
         DB::rollback();
         $pos=strpos($ex->getMessage(),'member_schedule_UX_2');
         if ($pos === false) {
            return ['Failed'];  // function failed due to unknown error
         } else {
            return [__('Name in schedule').' '.__('must be inique in the schedule')]; // function failed due to unique index violation
         }
      }
      DB::commit();
      return 'OK';
   }

}
