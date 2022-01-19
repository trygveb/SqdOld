<?php

namespace App\Http\Controllers;

use App\Actions\CreateEmailListAction;
use App\Models\SdSchema\V_MemberTraining;
use App\Models\SdSchema\V_MemberTrainingDate;
use App\Models\SdSchema\MemberTraining;
use App\Models\SdSchema\MemberTrainingDate;
use App\Models\SdSchema\Training;
use App\Models\SdSchema\TrainingDate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * class SchemaController 
 *
 * @author Trygve Botnen, 2021
 */
class SchemaController extends Controller {

   public function __construct() {
      $this->middleware('auth');
   }

   // Add dates to a training 
   // Returns to Add/Remove dates menu
   public function addDates(Request $request) {
      $data = request()->all();
      $numberOfDays = 0;
      $startDate = '';
      $trainingId = $data["trainingId"];
      foreach ($data as $key => $value) {
         if (substr($key, 0, 8) === 'quantity') {
            $numberOfDays = $value;
         } else if (substr($key, 0, 9) === 'startDate') {
            $startDate = $value;
         }
      }
      // dd('numberOfDays='.$numberOfDays.' startDate='.$startDate);
      $date0 = Carbon::createFromFormat('Y-m-d', $startDate);
      DB::beginTransaction();
      try {
         for ($d1 = 0; $d1 < $numberOfDays; $d1++) {
            $trainingDate = new TrainingDate();
            $trainingDate->training_date = $date0->addDays(7 * $d1)->toDateString();
            $trainingDate->training_id = $trainingId;
            $trainingDate->save();
            $this->addMembersToTrainingDate($trainingId, $trainingDate->id);
         }
      } catch (\Exception $e) {
         DB::rollBack();
      }


      DB::commit();
      $training = Training::find($trainingId);
      return redirect(route('admin.showAddRemoveDates', ['training' => $training]));
   }

   // Private function called from addDates
   private function addMembersToTrainingDate($trainingId, $trainingDateId) {
      $memberTrainings = MemberTraining::where('training_id', $trainingId)->get();
      foreach ($memberTrainings as $memberTraining) {
         $memberTrainingDate = new MemberTrainingDate();
         $memberTrainingDate->user_id = $memberTraining->user_id;
         $memberTrainingDate->training_date_id = $trainingDateId;
         $memberTrainingDate->save();
      }
   }

   // Adds members to a training 
   // Returns Members view
   public function addMember(Request $request) {
      $data = request()->all();
      $trainingId = $data["trainingId"];
      $training = Training::find($trainingId);
      $trainingDates = TrainingDate::where('training_id', $trainingId)->get();
      DB::beginTransaction();
      try {
         foreach ($data as $key => $value) {
            if (substr($key, 0, 4) === 'add_') {
               $atoms = explode('_', $key);
               $userId = $atoms[1];
               $memberTraining = MemberTraining::firstOrCreate(['user_id' => $userId, 'training_id' => $trainingId]);
               foreach ($trainingDates as $trainingDate) {
                  $memberTrainingDate = MemberTrainingDate::firstOrCreate(['user_id' => $userId, 'training_date_id' => $trainingDate->id]);
               }
            }
         }
      } catch (\Exception $e) {
         DB::rollBack();
      }
      DB::commit();
      return $this->Members($training);
   }

   // Adds a new user to the database (table Users)
   // Returns Members view
   public function addNewUser(Request $request) {
      $data = request()->all();
      $trainingId = $data["trainingId"];
      $training = Training::find($trainingId);
      $validatedData = $request->validate([
          'name' => ['required', 'unique:users', 'max:50'],
          'first_name' => ['required', 'max:50'],
          'last_name' => ['required', 'max:50'],
          'password' => ['required',
              'min:6',
              'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
          ],
          'email' => ['required', 'unique:users', 'max:100'],
      ]);
      $user = new User();
      $user->name = $data["name"];
      $user->email = $data["email"];
      $user->password = Hash::make($data["password"]);
      $user->authority = $data["authority"];
      $user->first_name = $data["first_name"];
      $user->last_name = $data["last_name"];
      $user->group = $data["group"];
      $user->save();

      return $this->Members($training);
   }

   // Removes a member from a training 
   // Returns Members view
   public function removeMember(Request $request) {
      $data = request()->all();
      $trainingId = $data["trainingId"];
      $training = Training::find($trainingId);
      foreach ($data as $key => $value) {
         if (substr($key, 0, 6) === 'delete') {
            $atoms = explode('_', $key);
            $userId = $atoms[1];
            $memberTraining = MemberTraining::where('user_id', $userId)
                    ->where('training_id', $trainingId)
                    ->first();
            $memberTraining->delete();
            // memberTrainingDates will be removed by the ON DELETE CASCADE clause in MySql
         }
      }

      return $this->Members($training);
   }

   //Show the schema
   public function index($trainingId = 1) {
      $mytime = Carbon::now();
      $today = $mytime->toDateString();

      //Fetch data from the database
      $training = Training::find($trainingId);
      $vMemberTrainingDates = V_MemberTrainingDate::where('training_date', '>=', $today)->get();
      $trainingDates = TrainingDate::where('training_id', $trainingId)
              ->where('training_date', '>=', $today)
              ->get();
      $memberTrainings = MemberTraining::where('training_id', $trainingId)->get();
      $admin= $memberTrainings->where('user_id',Auth::user()->id)->first()->admin;
      // Initialize the arrays to use in the view
      $statusSums = array();
      $statuses = array();
      $names = array();
      $groups = array();

      // Create the arrays
      $this->calaculateStatusSums($trainingDates, $vMemberTrainingDates, $statuses, $statusSums);
      $this->createNamesAndGroupsArrays($memberTrainings, $names, $groups);

      return view('sdSchema.schema', [
          'training' => $training,
          'numberOfDates' => count($trainingDates),
          'currentUser' => Auth::user(),
          'trainingDates' => $trainingDates,
          'statuses' => $statuses,
          'names' => $names,
          'groups' => $groups,
          'statusSums' => $statusSums,
          'admin' => $admin,
      ]);
   }

   //Called from the index function
   private function createNamesAndGroupsArrays($memberTrainings, &$names, &$groups) {
      foreach ($memberTrainings as $memberTraining) {
         $userId = $memberTraining->user_id;
         $user = User::find($userId);
         $names[$userId] = $user->name;
         $groups[$userId] = $user->groupsize->size;
      }
   }

   // Called from the index function
   private function calaculateStatusSums($trainingDates, $vMemberTrainingDates, &$statuses, &$statusSums) {
      foreach ($trainingDates as $trainingDate) {
         $memberTrainingsForDate = $vMemberTrainingDates
                 ->where('training_date', $trainingDate->training_date)
                 ->all();
         $sum = array(
             'Y' => 0,
             'N' => 0,
             'M' => 0, // M= Maybe
             'NA' => 0, // NA=No Answer
         );
         foreach ($memberTrainingsForDate as $memberTrainingForDate) {
            $statuses[$memberTrainingForDate->user_id][$trainingDate->id] = $memberTrainingForDate->status;
            switch ($memberTrainingForDate->status) {
               case 0: $sum['NA']++;
                  break;
               case 1: $sum['Y']++;
                  break;
               case 2: $sum['Y'] += 2;
                  break;
               case 3: $sum['N'] += $memberTrainingForDate->group;
                  break;
               default: $sum['M'] += $memberTrainingForDate->group;
                  break;
            }
         }
         array_push($statusSums, $sum);
      }
   }

   // Remove da´tes from a training
   public function removeDates(Request $request) {
      $data = request()->all();
      $trainingId = $data["trainingId"];
      foreach ($data as $key => $value) {
         if (substr($key, 0, 6) === 'delete') {
            $atoms = explode('_', $key);
            $trainingDateId = $atoms[1];
            $trainingDate = TrainingDate::find($trainingDateId);
            $trainingDate->delete();
         } else if (substr($key, 0, 10) === 'trainingId') {
//            $trainingId = $value;
         }
      }
      $training = Training::find($trainingId);
      return redirect(route('admin.showAddRemoveDates', ['training' => $training]));
   }

   // Show the Register New User Form
   public function showRegisterUser(Training $training) {
      return view('RegisterUser', [
          'training' => $training,
      ]);
   }

   public function showViewAddRemoveDates(Training $training) {
      
      $lastTrainingDate = $this->getLastTrainingDate($training);

      $danceTime = '19:00';   // TODO: Remve this hardcoded time
      // Create a Carbopnd date in order to calculate next date a week ahead, and the day of the week
      $dt = Carbon::parse($lastTrainingDate->training_date); 
      $nextDate = substr($dt->addWeeks(1), 0, 10);
      $weekDays = $dt->locale('sv')->dayName . 'ar';

      // Get day of week (0=Sunday, e= Monday etc).
      // This non-ISO format is used to be compatible with Javascript
      $weekDaysNumber = $dt->dayOfWeek;

      $mytime = Carbon::now();
      $today = $mytime->toDateString();

      $trainingDates = TrainingDate::where('training_id', $training->id)
              ->where('training_date', '>=', $today)
              ->get();

      return view('AddRemoveDates', [
          'training' => $training,
          'trainingDates' => $trainingDates,
          'currentUser' => Auth::user(),
          'weekdays' => $weekDays,
          'weekDaysNumber' => $weekDaysNumber,
          'lastTrainingDate' => $lastTrainingDate,
          'danceTime' => $danceTime,
          'nextDate' => $nextDate
      ]);
   }

   // Called from showViewAddRemoveDates
   // Return the last training date for a training. If no date exist, return today's date
   private function getLastTrainingDate($training) {
      $lastTrainingDate = TrainingDate::where('training_id', $training->id)
              ->orderByDesc('training_date')
              ->first();

      if (is_null($lastTrainingDate)) {
         $lastTrainingDate = new TrainingDate();
         $lastTrainingDate->training_date = substr(Carbon::now()->toISOString(), 0, 10);
      }
      return $lastTrainingDate;
   }

   // The functionality in the AddRemoveGroup view is not implemented
   public function showViewAddRemoveGroup() {
      return view('AddRemoveGroup', [
      ]);
   }

   // SHow the Members view
   public function ShowViewMembers(Training $training) {
      $createEmailListAction = new CreateEmailListAction();
      $emailArray = $createEmailListAction->execute($training->id);
      $emails = '';
      foreach ($emailArray as $email) {
         $emails .= $email . ', ';
      }
      $emails = substr($emails, 0, -2);
//      dd($emails);
      $members = V_MemberTraining::where('training_id', $training->id)->get();
//      $nonMembers = V_MemberTraining::where('training_id', '<>', $training->id)->get();

      $nonMembers = User::whereNotIn('id', function ($q) use ($training) {
                 $q->select('user_id')->from('member_training')->where('training_id', $training->id);
              })->get();

      return view('Members', [
          'training' => $training,
          'members' => $members,
          'nonMembers' => $nonMembers,
          'currentUser' => Auth::user(),
          'emails' => $emails
      ]);
   }

   // Show view AdminComments
   public function showViewAdminComments(Training $training) {
      // $training = Training::find($trainingId);
      $mytime = Carbon::now();
      $today = $mytime->toDateString();
      $vMemberTrainingDates = V_MemberTrainingDate::where('training_date', '>=', $today)->get();
      $trainingDates = TrainingDate::where('training_id', $training->id)
              ->where('training_date', '>=', $today)
              ->get();
      return view('AdminComments', [
          'training' => $training,
          'currentUser' => Auth::user(),
          'trainingDates' => $trainingDates,
      ]);
   }

   // Show view SchemaEdit for updating the member's attendance status
   public function showViewEdit(Training $training) {

      $mytime = Carbon::now();
      $today = $mytime->toDateString();
      $vMemberTrainingDates = V_MemberTrainingDate::where('training_date', '>=', $today)->get();
      $trainingDates = TrainingDate::where('training_id', $training->id)
              ->where('training_date', '>=', $today)
              ->get();
      $statuses = array();
      foreach ($trainingDates as $trainingDate) {
         $memberTrainingsForDate = $vMemberTrainingDates
                 ->where('training_date', $trainingDate->training_date)
                 ->where('user_id', Auth::user()->id)
                 ->all();
         foreach ($memberTrainingsForDate as $memberTrainingForDate) {
            $statuses[$trainingDate->id] = $memberTrainingForDate->status;
         }
      }

      return view('sdSchema.schemaEdit', [
          'training' => $training,
          'currentUser' => Auth::user(),
          'trainingDates' => $trainingDates,
          'statuses' => $statuses, // TODO: Only the statuses of the current user is needed
      ]);
   }

   // Show the Admin Menu. TODO: Cretae a real menu instead of a set of buttons
   public function showAdminMenu(Training $training) {

//      $training = Training::find($trainingId);
      return view('AdminMenu', [
          'training' => $training,
          'currentUser' => Auth::user(),
      ]);
   }

   //Updating the member's attendance status
   public function updateAttendance(Request $request) {
      $data = request()->all();
      $trainingId = 0;
      foreach ($data as $key => $value) {
         if (substr($key, 0, 6) === 'status') {
            $atoms = explode('_', $key);
            $userId = $atoms[1];
            $trainingDateId = $atoms[2];
            $memberTrainingDate = MemberTrainingDate::where('user_id', $userId)
                    ->where('training_date_id', $trainingDateId)
                    ->first();
            $memberTrainingDate->status = $value;
            $memberTrainingDate->save();
         } else if (substr($key, 0, 10) === 'trainingId') {
            $trainingId = $value;
         }
      }
      return redirect(route('sdSchema.index', ['trainingId' => $trainingId]));
   }

   // Update comemnts for one or more dates
   public function updateComments(Request $request) {
      $data = request()->all();
      $trainingId = 0;
      foreach ($data as $key => $value) {
         if (substr($key, 0, 7) === 'comment') {
            $atoms = explode('_', $key);
            $trainingDateId = $atoms[1];
            $trainingDate = TrainingDate::find($trainingDateId);
            $trainingDate->comment = $value;
            $trainingDate->save();
         } else if (substr($key, 0, 10) === 'trainingId') {
            $trainingId = $value;
         }
      }
      $training = Training::find($trainingId);
      // return redirect(route('admin.showMenu',['training' =>$training]));
      return redirect(route('sdSchema.index', ['trainingId' => $training->id]));
   }

}
