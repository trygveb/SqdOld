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
      if ($user->id== 1 || $user->id==2) {
         $memberTraining->admin=1;  // Make user 1 and 2 admin for the training
      }
      $memberTraining->save();
   }

   private function addOneUserToOneTrainingDate($trainingDate, $user) {
//      printf("Adding user %d to trainingDate %s\n", $user->id, $trainingDate->training_date);
      $memberTrainingDate = new MemberTrainingDate;
      $memberTrainingDate->user_id = $user->id;
      $memberTrainingDate->training_date_id = $trainingDate->id;
      $groupSize = Groupsize::where('user_id', $user->id)->first()->size;
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
      $memberTrainingDate->status = $status;
      $memberTrainingDate->save();
   }

   private function addUserToTrainingDates($user, $trainingDates) {
      foreach ($trainingDates as $trainingDate) {
         $this->addOneUserToOneTrainingDate($trainingDate, $user);
      }
   }

   /**
    * Add user Adam to both trainings
    * Add all other users except Kain to one training.
    * @param type $users
    * @param type $trainings
    */
   private function addUsersToTrainings($users, $trainings) {
      foreach ($trainings as $training) {
         $trainingDates = $training->trainingDates;

         foreach ($users as $user) {
            if ($user->name != 'Kain') {
               if (($user->id % 2) == ($training->id - 1) || $user->name == 'Adam') {
                  $this->addOneUserToOneTraining($user, $training);
                  $this->addUserToTrainingDates($user, $trainingDates);
               }
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

   private function createAdamAndEve() {
      $password = env('ADMIN_PASSWORD', 'i-love-laravel');
      $passwordHashed = Hash::make($password = $password);
      User::factory()->create([
          'email' => 'adam@gmail.com',
          'password' => $passwordHashed,
          'name' => 'Adam First',
          'authority' => 1
      ]);
      User::factory()->create([
          'email' => 'eve@gmail.com',
          'password' => $passwordHashed,
          'name' => 'Eve Second',
          'authority' => 0
      ]);
      User::factory()->create([
          'email' => 'kain@gmail.com',
          'password' => $passwordHashed,
          'name' => 'Kain Third',
          'authority' => 0,
          'email_verified_at' => NULL
      ]);
      return $passwordHashed;
   }

   private function createUsers() {
      $passwordHashed= $this->createAdamAndEve();
      $titles = ['Dr.', 'Mr.', 'Mrs.', 'Ms.', 'Miss', 'Prof.'];
      User::factory(20)->create();
      $users = User::all();
      foreach ($users as $user) {
         $user->password= $passwordHashed;
         $atoms = explode(' ', $user->name);
         $lastName=$atoms[count($atoms)-1];
         if (in_array($atoms[0], $titles)) {
            $user->name = $atoms[1];
         } else {
            $user->name = $atoms[0];
         }
         $atoms = explode('@', $user->email);
         $atoms[0]=$user->name.'.'.$lastName;
         $user->email= implode('@', $atoms);
         $user->save();
         $groupsize = new Groupsize;
         $groupsize->user_id = $user->id;
         if ($user->id == 1) {
            $groupsize->size = 1;   //Trygve
         } elseif ($user->id == 2) {
            $groupsize->size = 2;  // Arne
         } elseif ($user->id > 5) {
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
