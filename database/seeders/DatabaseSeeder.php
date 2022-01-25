<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

use App\Models\Schedule\Schedule;
use App\Models\Schedule\MemberSchedule;
use App\Models\Schedule\MemberScheduleDate;
use App\Models\Schedule\ScheduleDate;

class DatabaseSeeder extends Seeder {

   /**
    * Seed the application's database.
    *
    * @return void
    */
   public function run() {

      $this->prepareSeed();

      $schedules = $this->createSchedulesAndScheduleDates();

      $users = $this->createOtherUsers();

      $this->addUsersToSchedules($users, $schedules);
   }

   private function addOneUserToOneSchedule($user, $schedule) {
//      printf("Adding user %d to schedule %s\n", $user->id, $schedule->id);
      $memberSchedule = new MemberSchedule;
      $memberSchedule->user_id = $user->id;
      $memberSchedule->schedule_id = $schedule->id;
      if ($user->id == 1 || $user->id == 2) {
         $memberSchedule->admin = 1;  // Make user 1 and 2 admin for the schedule
      }
      if ($user->id % 3 === 0) {
         $memberSchedule->group_size = 2;  // Default is 1
      }
      $memberSchedule->save();
   }

   private function addOneUserToOneScheduleDate($scheduleDate, $user, $groupSize) {
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

   private function addUserToScheduleDates($user, $scheduleDates) {

      foreach ($scheduleDates as $scheduleDate) {
         $scheduleId = $scheduleDate->schedule_id;
         $groupSize = MemberSchedule::where('schedule_id', $scheduleId)
                         ->where('user_id', $user->id)
                         ->first()
                 ->group_size;
         ;
         $this->addOneUserToOneScheduleDate($scheduleDate, $user, $groupSize);
      }
   }

   /**
    * Add user Adam to both schedules
    * Add all other users except Kain to one schedule.
    * @param type $users
    * @param type $schedules
    */
   private function addUsersToSchedules($users, $schedules) {
      foreach ($schedules as $schedule) {
         $scheduleDates = $schedule->scheduleDates;

         foreach ($users as $user) {
            if ($user->name != 'Kain') {
               if (($user->id % 2) == ($schedule->id - 1) || $user->name == 'Adam') {
                  $this->addOneUserToOneSchedule($user, $schedule);
                  $this->addUserToScheduleDates($user, $scheduleDates);
               }
            }
         }
      }
   }

   private function createHashedPassword() {
      $password = env('ADMIN_PASSWORD', 'i-love-laravel');
      $hashedPassword = Hash::make($password);
      if (!Hash::check($password, $hashedPassword)) {
         echo "Pasword does not match!\n";
      }
      return$hashedPassword;
   }
   
   private function createScheduleDate($schedule, $start, $w) {
      $scheduleDate = new ScheduleDate;
      $scheduleDate->schedule_id = $schedule->id;
      $scheduleDate->schedule_date = $start->addWeeks($w);
      $scheduleDate->save();
   }
   

   private function createSchedulesAndScheduleDates() {
      // Create schedules and schedule dates
      Schedule::firstOrCreate([
          'name' => 'C3 Wednesdays',
          'description' => '',
          'password' => $this->createHashedPassword()
      ]);
      Schedule::firstOrCreate([
          'name' => 'C2 Mondays',
          'description' => 'For beginners',
      ]);
      Schedule::firstOrCreate([
          'name' => 'C4 part 3',
          'description' => 'By invitation only',
          'password' => $this->createHashedPassword()
      ]);
      Schedule::firstOrCreate([
          'name' => 'C1 Mondays',
          'description' => 'Training',
      ]);
      $schedules = Schedule::all();
      $start = Carbon::now()->addDay();
      foreach ($schedules as $schedule) {
         for ($w = 0; $w < 7; $w++) {
            $this->createScheduleDate($schedule, $start, $w);
         }
         $start = Carbon::now()->addDays(2);
      }
      return $schedules;
   }

   private function createFirstUsers() {
      $hashedPassword = $this->createHashedPassword();
      User::factory()->create([
          'email' => 'adam@gmail.com',
          'password' => $hashedPassword,
          'name' => 'Adam',
          'authority' => 1
      ]);
      User::factory()->create([
          'email' => 'eve@gmail.com',
          'password' => $hashedPassword,
          'name' => 'Eve',
          'authority' => 0
      ]);
      User::factory()->create([
          'email' => 'kain@gmail.com',
          'password' => $hashedPassword,
          'name' => 'Kain',
          'authority' => 0,
          'email_verified_at' => NULL
      ]);
      User::factory()->create([
          'email' => 'abel@gmail.com',
          'password' => $hashedPassword,
          'name' => 'Abel',
          'authority' => 0,
          'email_verified_at' => NULL
      ]);
      return User::count();
   }

   private function createOtherUsers() {
      $numberOfFirstUsers = $this->createFirstUsers();
      $hashedPassword = $this->createHashedPassword();

      $titles = ['Dr.', 'Mr.', 'Mrs.', 'Ms.', 'Miss', 'Prof.'];
      User::factory(20)->create();
      $users = User::all();
      foreach ($users as $user) {
         if ($user->id > $numberOfFirstUsers) {
            $user->password = $hashedPassword;
            $userAtoms = explode(' ', $user->name);
            $lastName = $userAtoms[count($userAtoms) - 1];
            if (in_array($userAtoms[0], $titles)) {
               $user->name = $userAtoms[1];
            } else {
               $user->name = $userAtoms[0];
            }
            $emailAtoms = explode('@', $user->email);
            $emailAtoms[0] = $user->name . '.' . $lastName;
            $user->email = strtolower(implode('@', $emailAtoms));
            $user->save();
         }
      }

      return User::all();
   }

   private function prepareSeed() {
      // Delete all users. By the FK relationship ON DELETE CASCADE,
      // the data in tables member_schedule and member_schedule will also be deleted.
      DB::connection('laravel')->table('users')->delete();

      // Delete all schedules and By the FK relationship ON DELETE CASCADE,
      // the data in table schedule_date will also be deleted.
      DB::connection('schedule')->table('schedule')->delete();

      DB::statement('ALTER TABLE laravel.users AUTO_INCREMENT=0;');
      DB::statement('ALTER TABLE schedule.schedule AUTO_INCREMENT=0;');
      DB::statement('ALTER TABLE schedule.schedule_date AUTO_INCREMENT=0;');
      DB::statement('ALTER TABLE schedule.member_schedule AUTO_INCREMENT=0;');
      DB::statement('ALTER TABLE schedule.member_schedule_date AUTO_INCREMENT=0;');
   }

}
