<?php

namespace App\Models\Schedule;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {

   protected $connection = 'schedule';
   protected $table = 'schedule';

   public function scheduleDates() {
      return $this->hasMany(ScheduleDate::class);
   }

}
