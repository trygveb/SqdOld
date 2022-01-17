<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\SdSchema\Groupsize;
use App\Models\SdSchema\Training;
use App\Models\SdSchema\MemberTraining;
use App\Models\SdSchema\MemberTrainingDate;
use App\Models\SdSchema\TrainingDate;

class DatabaseSeeder extends Seeder {

   /**
    * Seed the application's database.
    *
    * @return void
    */
   public function run() {

      $this->prepareSeed();

      $trainings = $this->createTrainingsAndTrainingDates();

      $users = $this->createUsers();

      $this->addUsersToTrainings($users, $trainings);
   }

   private function addOneUserToOneTraining($user, $training) {
//      printf("Adding user %d to training %s\n", $user->id, $training->id);
      $memberTraining = new MemberTraining;
      $memberTraining->user_id = $user->id;
      $memberTraining->training_id = $training->id;
      $memberTraining->save();
   }

   private function addOneUserToOneTrainingDate($trainingDate, $user) {
//      printf("Adding user %d to trainingDate %s\n", $user->id, $trainingDate->training_date);
      $memberTrainingDate = new MemberTrainingDate;
      $memberTrainingDate->user_id = $user->id;
      $memberTrainingDate->training_date_id = $trainingDate->id;
      $groupSize= Groupsize::where('user_id', $user->id)->first()->size;
      $year= substr($trainingDate->training_date,0,4);
      $month= substr($trainingDate->training_date,5,2);
      $day= substr($trainingDate->training_date,8,2);
      $ms1= Carbon::createFromDate($year,$month,$day)->timestamp+ $user->id;
      $status= $ms1 % 5;
      if ($groupSize == 1 && $status==2) {
         $status=1;
      }
      /*
 switch ($status) {
                      case 1: if ($group==1) {
                                 $statusName='Ja';
                              } else {
                                 $statusName='1';
                              }
                              break;
                      case 2: $statusName='2';
                              break;
                      case 3: $statusName='Nej';
                              break;
                      case 4: $statusName='Kanske';
                              break;
                     }
       */
      $memberTrainingDate->status= $status;
      $memberTrainingDate->save();
   }

   private function addUserToTrainingDates($user, $trainingDates) {
      foreach ($trainingDates as $trainingDate) {
         $this->addOneUserToOneTrainingDate($trainingDate, $user);
      }
   }

   private function addUsersToTrainings($users, $trainings) {
      foreach ($trainings as $training) {
         $trainingDates = $training->trainingDates;
         
         foreach ($users as $user) {
            if (($user->id % 2) == ($training->id - 1)) {
               $this->addOneUserToOneTraining($user, $training);
               $this->addUserToTrainingDates($user, $trainingDates);
            }
         }
      }
   }

   private function createTrainingDate($training, $start, $w) {
      $trainingDate = new TrainingDate;
      $trainingDate->training_id = $training->id;
      $trainingDate->training_date = $start->addWeeks($w);
      $trainingDate->save();
   }

   private function createTrainingsAndTrainingDates() {
      // Create trainings and training dates
      Training::firstOrCreate([
          'name' => 'C3 Onsdagar'
      ]);
      Training::firstOrCreate([
          'name' => 'C2 Måndagar'
      ]);
      $trainings = Training::all();
      $start = Carbon::now()->addDay();
      foreach ($trainings as $training) {
         for ($w = 0; $w < 7; $w++) {
            $this->createTrainingDate($training, $start, $w);
         }
         $start = Carbon::now()->addDays(2);
      }
      return $trainings;
   }

   private function createUsers() {
      $adninPassword = env('ADMIN_PASSWORD', 'i-love-laravel');
      $adninPasswordHashed = Hash::make($password = $adninPassword);
      User::factory()->create([
          'email' => 'trygve.botnen@gmail.com',
          'password' => $adninPasswordHashed,
          'name' => 'Trygve Botnen',
          'authority' => 1
      ]);
      User::factory(20)->create();
      $users = User::all();
      foreach ($users as $user) {
         $groupsize = new Groupsize;
         $groupsize->user_id = $user->id;
         if ($user->id > 5) {
            $groupsize->size = 2;
         }
         $groupsize->save();
      }

      return User::all();
   }

   private function prepareSeed() {
      // Delete all users. By the FK relationship ON DELETE CASCADE,
      // the data in tables member_training and member_training will also be deleted.
      DB::connection('sqd')->table('users')->delete();

      // Delete all trainings and By the FK relationship ON DELETE CASCADE,
      // the data in table training_date will also be deleted.
      DB::connection('sdSchema')->table('training')->delete();

      DB::statement('ALTER TABLE users AUTO_INCREMENT=0;');
      DB::statement('ALTER TABLE sdSchema.training AUTO_INCREMENT=0;');
      DB::statement('ALTER TABLE sdSchema.training_date AUTO_INCREMENT=0;');
      DB::statement('ALTER TABLE sdSchema.member_training AUTO_INCREMENT=0;');
      DB::statement('ALTER TABLE sdSchema.member_training_date AUTO_INCREMENT=0;');
      DB::statement('ALTER TABLE sdSchema.groupsize AUTO_INCREMENT=0;');
   }


}
