<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
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

      DB::connection('sqd')->table('users')->delete();
//      DB::connection('sdSchema')->table('member_training')->delete();
      DB::connection('sdSchema')->table('training_date')->delete();
      DB::connection('sdSchema')->table('training')->delete();

//      Artisan::call('migrate:rollback');
//      Artisan::call('migrate');

      $training = Training::firstOrCreate([
                  'name' => 'C3 Onsdagar'
      ]);
      $start = Carbon::now()->addDay();
      for ($w = 0; $w < 7; $w++) {
         $this->createTrainingDate($training, $start, $w);
      }
      
      User::factory(10)->create();
      $users= User::all();
      
      $i=0;
      foreach ($users as $user) {
          $this->addUserToTraining($user, $training);
          $groupsize= new Groupsize;
          $groupsize->user_id= $user->id;
          if ($i <4) {
             $groupsize->size=2;
          }
          $i++;
          $groupsize->save();
       }
       $trainingDates=TrainingDate::all();
       foreach ($users as $user) {
          foreach($trainingDates as $trainingDate) {
             $this->addUserToTrainingDate($trainingDate, $user);
          }
       }
       
   }
   
   private function createTrainingDate($training, $start, $w) {
         $trainingDate = new TrainingDate;
         $trainingDate->training_id = $training->id;
         $trainingDate->training_date = $start->addWeeks($w);
         $trainingDate->save();
   }
   private function addUserToTraining($user, $training) {
      $memberTraining= new MemberTraining;
      $memberTraining->user_id= $user->id;
      $memberTraining->training_id=$training->id;
      $memberTraining->save();
   }
   private function addUserToTrainingDate($trainingDate, $user) {
      $memberTrainingDate= new MemberTrainingDate;
      $memberTrainingDate->user_id= $user->id;
      $memberTrainingDate->training_date_id= $trainingDate->id;
      $memberTrainingDate->status=1;
      $memberTrainingDate->save();
      
   }
}
