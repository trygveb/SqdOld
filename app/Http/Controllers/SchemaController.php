<?php

namespace App\Http\Controllers;

use App\Classes\CreateEmailList;
use App\Http\Controllers\BaseController;
use App\Models\Schedule\V_MemberSchedule;
use App\Models\Schedule\V_MemberScheduleDate;
use App\Models\Schedule\MemberSchedule;
use App\Models\Schedule\MemberScheduleDate;
use App\Models\Schedule\Schedule;
use App\Models\Schedule\ScheduleDate;
use App\Models\User;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Classes\Utility;

/**
 * class SchemaController 
 *
 * @author Trygve Botnen, 2021
 */
class SchemaController extends BaseController {

   public function __construct() {
      $this->middleware('auth');
   }

//Show a schedule
   public function index($scheduleId, $showHistory = 0) {
      $mytime = Carbon::now();
      $today = $mytime->toDateString();

//Fetch data from the database
      $schedule = Schedule::find($scheduleId);
      $memberSchedules = MemberSchedule::where('schedule_id', $scheduleId)->get();
      
      // Check if user is member or root, if not redirect back

      $editAllowed = true;
      if ($memberSchedules->where('user_id', Auth::id())->count() == 0) {
         // User is not member
         if (Auth::user()->isRoot()) {
            // User is root, and may view but not edit
            $editAllowed = false;
         } else {
             // User is not root nor member. Redirect back
            $vMemberSchedules = V_MemberSchedule::where('user_id', Auth::id())->get();
            return view('schedule.welcome', [
                'mySchedulesCount' => $vMemberSchedules->count(),
                'vMemberSchedules' => $vMemberSchedules,
                'names' => $this->names()
            ]);
         }
      }
      if ($showHistory == 0) {
         $vMemberScheduleDates = V_MemberScheduleDate::where('schedule_date', '>=', $today)
                 ->where('schedule_id', $scheduleId)
                 ->get();
         $scheduleDates = ScheduleDate::where('schedule_id', $scheduleId)
                 ->where('schedule_date', '>=', $today)
                 ->get();
      } else {
         $vMemberScheduleDates = V_MemberScheduleDate::where('schedule_id', $scheduleId)
                 ->get();
         $scheduleDates = ScheduleDate::where('schedule_id', $scheduleId)
                 ->get();
      }
// Initialize the arrays to use in the view
      $statusSums = array();
      $statuses = array();
      $memberNames = array();
      $groups = array();

// Create the arrays
      $this->calaculateStatusSums($scheduleDates, $vMemberScheduleDates, $statuses, $statusSums);
      $this->createNamesAndGroupsArrays($memberSchedules, $memberNames, $groups);

      return view('schedule.schema', [
          'schedule' => $schedule,
          'numberOfDates' => count($scheduleDates),
          'currentUser' => Auth::user(),
          'scheduleDates' => $scheduleDates,
          'statuses' => $statuses,
          'memberNames' => $memberNames,
          'groups' => $groups,
          'statusSums' => $statusSums,
          'admin' => Utility::getAdminForSchedule($scheduleId),
          'names' => $this->names(),
          'showHistory' => $showHistory,
          'editAllowed' => $editAllowed
      ]);
   }
   

   public function showReleaseNotes_2_2() {
      return view('schedule.releaseNotes_2_2', [
          'names' => $this->names(),
      ]);
   }
//Called from the index function
   private function createNamesAndGroupsArrays($memberSchedules, &$names, &$groups) {
      foreach ($memberSchedules as $memberSchedule) {
         $userId = $memberSchedule->user_id;
         // $user = User::find($userId);
         $names[$userId] = $memberSchedule->name_in_schema;
         $groups[$userId] = $memberSchedule->group_size;
      }
   }

   /*    * Calcualte status sums. NOTE! Will only work for group size 1 or 2.
    * 
    * @param collection ScheduleDates          all (future) ScheduleDates for the given schedule
    * @param collection $vMemberScheduleDates  all (future) V_MemberScheduleDates for the given  schedule
    * @param out $statusSums
    */

   private function calaculateStatusSums($scheduleDates, $vMemberScheduleDates, &$statuses, &$statusSums) {
      foreach ($scheduleDates as $scheduleDate) {
         $memberSchedulesForDate = $vMemberScheduleDates
                 ->where('schedule_date', $scheduleDate->schedule_date)
                 ->all();
         $sum = array(
             'Y' => 0,
             'N' => 0,
             'M' => 0, // M= Maybe
             'NA' => 0, // NA=No Answer
         );
         foreach ($memberSchedulesForDate as $memberScheduleForDate) {
            $statuses[$memberScheduleForDate->user_id][$scheduleDate->id] = $memberScheduleForDate->status;
            switch ($memberScheduleForDate->status) {
               case 0: $sum['NA'] += $memberScheduleForDate->group_size;
                  break;
               case 1: $sum['Y']++; // If one member says yes, the others says no
                  $sum['N'] += ($memberScheduleForDate->group_size - 1);
                  break;
               case 2: $sum['Y'] += 2;
                  break;
               case 3: $sum['N'] += $memberScheduleForDate->group_size;
                  break;
               default: $sum['M'] += $memberScheduleForDate->group_size;
                  break;
            }
         }
         array_push($statusSums, $sum);
      }
   }

// Add dates to a schedule 
// Returns to Add/Remove dates menu
   public function addDates(Request $request) {
      $data = request()->all();
      $numberOfDays = 0;
      $startDate = '';
      $scheduleId = $data["scheduleId"];
      foreach ($data as $key => $value) {
         if (substr($key, 0, 8) === 'quantity') {
            $numberOfDays = $value;
         } else if (substr($key, 0, 9) === 'startDate') {
            $startDate = $value;
         }
      }
      $date0 = Carbon::createFromFormat('Y-m-d', $startDate);
      DB::beginTransaction();
      try {
         for ($d1 = 0; $d1 < $numberOfDays; $d1++) {
            $scheduleDate = new ScheduleDate();
            // As date0 is modified by addDays, we must only add 7 days each loop
            // (but zero days on the first loop)
            $scheduleDate->schedule_date = $date0->addDays(7 * min(1, $d1))->toDateString();
            $scheduleDate->schedule_id = $scheduleId;
            $scheduleDate->save();
            $this->addMembersToScheduleDate($scheduleId, $scheduleDate->id);
         }
      } catch (\Exception $e) {
         DB::rollBack();
      }


      DB::commit();
//      $schedule = Schedule::find($scheduleId);
      return redirect(route('schedule.showAddRemoveDates', ['scheduleId' => $scheduleId]));
   }

// Remove dates from a schedule
   public function removeDates(Request $request) {
      $data = request()->all();
      $scheduleId = $data["scheduleId"];
      foreach ($data as $key => $value) {
         if (substr($key, 0, 6) === 'delete') {
            $atoms = explode('_', $key);
            $scheduleDateId = $atoms[1];
            $scheduleDate = ScheduleDate::find($scheduleDateId);
            $scheduleDate->delete();
         } else if (substr($key, 0, 10) === 'scheduleId') {
//            $scheduleId = $value;
         }
      }
//      $schedule = Schedule::find($scheduleId);
      return redirect(route('schedule.showAddRemoveDates', ['scheduleId' => $scheduleId]));
   }

// Private function called from addDates
   private function addMembersToScheduleDate($scheduleId, $scheduleDateId) {
      $memberSchedules = MemberSchedule::where('schedule_id', $scheduleId)->get();
      foreach ($memberSchedules as $memberSchedule) {
         $memberScheduleDate = new MemberScheduleDate();
         $memberScheduleDate->user_id = $memberSchedule->user_id;
         $memberScheduleDate->schedule_date_id = $scheduleDateId;
         $memberScheduleDate->save();
      }
   }

   // Add registered member(s) to a schedule
// Called from the adminMembers view
// Returns Members view
   public function connectMember(Request $request) {
      $data = request()->all();
      $scheduleId = $data["scheduleId"];
      $schedule = Schedule::find($scheduleId);
      foreach ($data as $key => $value) {
         if (substr($key, 0, 7) === 'connect') {
            // checkbox action is checked. Connect the user to the schema
            $atoms = explode('_', $key);
            $userId = $atoms[1];
            //$name= $data['nameInSchema_'.$userId];
            $groupSize = $data['number_' . $userId];
            $nameInSchema = $data['nameInSchema_' . $userId];

            $status = $schedule->addMember($userId, $groupSize, $nameInSchema);
            if ($status != 'OK') {
               return Redirect::back()->withErrors($status);
               //return $this->ShowViewMembers($scheduleId, $status);
            }
         }
      }
      return Redirect::back();
//      return $this->ShowViewMembers($scheduleId);
   }

// Update the admin flags or remove members from a schedule
// Called from the adminMembers view
// Returns Members view
   public function updateMember(Request $request) {
      $data = request()->all();

      $scheduleId = $data["scheduleId"];

// Update admin flags and name_in_schema. Loop over all users in the schedule
      // $userIds = MemberSchedule::where('schedule_id', $scheduleId)->get()->pluck('user_id');
      $memberSchedules = MemberSchedule::where('schedule_id', $scheduleId)->get();
      $nameInSchema = $this->checkNameInSchema($memberSchedules, $request);
      if ($nameInSchema != "") {
         $errors = [
             'error' => __('Name in schema must be unique in the schema') . ': ' . $nameInSchema
         ];
         return $this->ShowViewMembers($scheduleId, $errors);
      }
      //foreach ($userIds as $userId) {
      foreach ($memberSchedules as $memberSchedule) {
         $userId = $memberSchedule->user_id;
         $adminHtmlElementName = 'admin_' . $userId;  //name of html element
//         dd(print_r($data, true));
         if ($request->has($adminHtmlElementName)) {
            $memberSchedule->admin = 1;
         } else {
            $memberSchedule->admin = 0;
         }

         $memberSchedule->name_in_schema = $request['nameInSchema_' . $userId];
         ;
         $numberName = 'number_' . $userId;   //name of html element
         $memberSchedule->group_size = $request[$numberName];
         $memberSchedule->save();
      }
      // dd(print_r($nameInSchemaNames, true));
      // Remove member(s) from all scheduledates in the schedule
      $scheduleDates = ScheduleDate::where('schedule_id', $scheduleId)->get();
      foreach ($data as $key => $value) {
         if (substr($key, 0, 6) === 'remove') {
            $atoms = explode('_', $key);
            $userId = $atoms[1];
            $this->removeMemberFromSchema($userId, $scheduleId, $scheduleDates);
         }
      }

      return $this->ShowViewMembers($scheduleId);
   }

   private function checkNameInSchema($memberSchedules, $request) {
      $returnValue = "";
      foreach ($memberSchedules as $memberSchedule) {
         $userId = $memberSchedule->user_id;
         $newNameInSchema = $request['nameInSchema_' . $userId];
         //$oldNameInSchema=$memberSchedule->name_in_schema;
         $testMemberSchedules = $memberSchedules
                 ->where('name_in_schema', $newNameInSchema)
                 ->where('user_id', '<>', $userId)
                 ->all();
//         foreach ($testMemberSchedules as $testMemberSchedule) {
//            if ($testMemberSchedule->user_id != $userId) {
//               $returnValue= $newNameInSchema;
//               break;
//            }
//         }
         if (count($testMemberSchedules) > 0) {
            $returnValue = $newNameInSchema;
            break;
         }
      }
      return $returnValue;
   }

   // Remove a member from aschedula and all scheduledates in the schedule
   private function removeMemberFromSchema($userId, $scheduleId, $scheduleDates) {
      foreach ($scheduleDates as $scheduleDate) {
         $memberScheduleDate = MemberScheduleDate::where('user_id', $userId)->where('schedule_date_id', $scheduleDate->id)->first();
         $memberScheduleDate->delete();
      }
      $memberSchedule = MemberSchedule::where('user_id', $userId)
              ->where('schedule_id', $scheduleId)
              ->first();
      $memberSchedule->delete();
   }

// Show the Register New User Form
   public function showRegisterUser($scheduleId) {
      $schedule = Schedule::find($scheduleId);
      $isAdmin = Utility::getAdminForSchedule($scheduleId);
      return view('auth.registration', [
          'scheduleId' => $scheduleId,
          'scheduleName' => $schedule->name,
          'isAdmin' => $isAdmin,
          'names' => $this->names(),
      ]);
   }

// Show the Register New Schedule Form
   public function showRegisterSchedule() {
      return view('schedule.admin.registerNewSchedule', [
          'names' => $this->names(),
      ]);
   }

   public function registerNewSchedule(Request $request) {
      $data = request()->all();

      $schedule = new Schedule();
      $schedule->name = $data["schedule_name"];
      $schedule->default_weekday = $data["weekday"];
      $schedule->description = $data["schedule_description"];
      $schedule->default_start_time = $data["schedule_time"];
      $nameInSchema = $data["name_in_schema"];
      DB::beginTransaction();
      try {
         $schedule->save();
         // Connect current user (Schema administrator) to the new schedule
         // with admin=2 (Schema administrator authority)
         $status = $schedule->addMember(Auth::user()->id, 1, $nameInSchema,2);
         if ($status != 'OK') {
            return back()->with('error', __('Schedule :name could not be registered! Status=:status',
                                    ['name' => $data['schedule_name'],
                                        'status' => $status]));
         }
      } catch (\Exception $e) {
         DB::rollBack();
         return back()->with('error', __('Schedule :name could not be registered!', ['name' => $data['schedule_name']]));
      }
      DB::commit();

      return back()->with('success', __('Schedule :name has been registered!', ['name' => $data['schedule_name']]));
   }

   public function showAddRemoveDates($scheduleId) {

      $schedule = Schedule::find($scheduleId);
      $lastScheduleDate = $this->getLastScheduleDate($schedule);

      $danceTime = '19:00';   // TODO: Remve this hardcoded time
// Create a Carbopnd date in order to calculate next date a week ahead, and the day of the week
      $dt = Carbon::parse($lastScheduleDate->schedule_date);
      $nextDate = substr($dt->addWeeks(1), 0, 10);
      $currentLocale = LaravelLocalization::getCurrentLocale();
//      if ($currentLocale ==='se') {
//         $currentLocale= 'sv';
//      }
      $weekDays = $dt->locale($currentLocale)->dayName;

// Get day of week (0=Sunday, e= Monday etc).
// This non-ISO format is used to be compatible with Javascript
      $weekDaysNumber = $dt->dayOfWeek;

      $mytime = Carbon::now();
      $today = $mytime->toDateString();

      $scheduleDates = ScheduleDate::where('schedule_id', $schedule->id)
              ->where('schedule_date', '>=', $today)
              ->get();

      return view('schedule.admin.addRemoveDates', [
          'schedule' => $schedule,
          'scheduleDates' => $scheduleDates,
          'currentUser' => Auth::user(),
          'weekdays' => $weekDays,
          'weekDaysNumber' => $weekDaysNumber,
          'lastScheduleDate' => $lastScheduleDate,
          'danceTime' => $danceTime,
          'nextDate' => $nextDate,
          'names' => $this->names(),
          'admin' => Utility::getAdminForSchedule($scheduleId)
      ]);
   }

// Called from showViewAddRemoveDates
// Return the last schedule date for a schedule. If no date exist, return today's date
   private function getLastScheduleDate($schedule) {
      $lastScheduleDate = ScheduleDate::where('schedule_id', $schedule->id)
              ->orderByDesc('schedule_date')
              ->first();

      if (is_null($lastScheduleDate)) {
         $lastScheduleDate = new ScheduleDate();
         $lastScheduleDate->schedule_date = substr(Carbon::now()->toISOString(), 0, 10);
      }
      return $lastScheduleDate;
   }

   public function ShowViewAdminRegisterMember($scheduleId, $status = []) {
      $schedule = Schedule::find($scheduleId);
      if (is_null($schedule)) {
         dd("ShowNotViewMembers " . $scheduleId);
      }
      $admin = V_MemberSchedule::where('schedule_id', $scheduleId)
              ->where('user_id', Auth::user()->id)
              ->pluck('admin')
              ->first();
      if ($admin === 0 && Auth::user()->isRoot() == 0) {
         return view('errors.403')->with('names', $this->names());
      }
      return view('schedule.admin.registerMember', [
          'schedule' => $schedule,
          'currentUser' => Auth::user(),
          'names' => $this->names(),
          'admin' => Utility::getAdminForSchedule($scheduleId),
          'status' => $status
      ]);
   }

// SHow the Members view
   public function ShowViewMembers($scheduleId, $status = []) {
      $schedule = Schedule::find($scheduleId);
      if (is_null($schedule)) {
         dd("ShowViewMembers " . $scheduleId);
      }
      $admin = V_MemberSchedule::where('schedule_id', $scheduleId)
              ->where('user_id', Auth::user()->id)
              ->pluck('admin')
              ->first();
      if ($admin === 0 && Auth::user()->authority === 0) {
         return view('errors.403')->with('names', $this->names());
      }
      $createEmailListAction = new CreateEmailList();
      $emailArray = $createEmailListAction->execute($schedule->id);
      $emails = '';
      foreach ($emailArray as $email) {
         $emails .= $email . ', ';
      }
      $emails = substr($emails, 0, -2);
      $vMemberSchedules = V_MemberSchedule::where('schedule_id', $schedule->id)
              ->orderBy('user_name', 'asc')
              ->get();
      $memberUserIds = [];
      foreach ($vMemberSchedules as $member) {
         array_push($memberUserIds, $member->user_id);
      }
      $allUsers = User::all();

      $nonMembers = collect();
      foreach ($allUsers as $user) {
         if (!in_array($user->id, $memberUserIds)) {
            $nonMember = new V_MemberSchedule();
            $nonMember->schedule_id = $schedule->id;
            $nonMember->user_id = $user->id;
            $nonMember->user_name = $user->name;
            $nonMember->schedule_name = $schedule->name;
            $nonMember->name_in_schema = explode(" ", $user->name)[0];
            $nonMember->email = $user->email;
            $nonMember->admin = 0;
            $nonMember->group_size = 1;          // TOD: FIX
            $nonMembers->push($nonMember);
         }
      }
      $sortedNonMembers = $nonMembers->sortBy('user_name');
      $sortedNonMembers->values()->all();
      return view('schedule.admin.members', [
          'schedule' => $schedule,
          'vMemberSchedules' => $vMemberSchedules,
          'nonMembers' => $sortedNonMembers,
          'currentUser' => Auth::user(),
          'emails' => $emails,
          'names' => $this->names(),
          'admin' => Utility::getAdminForSchedule($scheduleId),
          'status' => $status
      ]);
   }

   public function ShowViewNotConnectedMembers($scheduleId, $status = []) {
      $schedule = Schedule::find($scheduleId);
      if (is_null($schedule)) {
         dd("ShowNotViewMembers " . $scheduleId);
      }
      $admin = V_MemberSchedule::where('schedule_id', $scheduleId)
              ->where('user_id', Auth::user()->id)
              ->pluck('admin')
              ->first();
      if ($admin === 0 && Auth::user()->authority === 0) {
         return view('errors.403')->with('names', $this->names());
      }
      $vMemberSchedules = V_MemberSchedule::where('schedule_id', $schedule->id)
              ->orderBy('user_name', 'asc')
              ->get();
      $memberUserIds = [];
      foreach ($vMemberSchedules as $member) {
         array_push($memberUserIds, $member->user_id);
      }
      $allUsers = User::all();

      $nonMembers = collect();
      $members = collect();
      foreach ($allUsers as $user) {
         if (!in_array($user->id, $memberUserIds)) {
            $nonMember = new V_MemberSchedule();
            $nonMember->schedule_id = $schedule->id;
            $nonMember->user_id = $user->id;
            $nonMember->user_name = $user->complete_name;
            $nonMember->schedule_name = $schedule->name;
            $nonMember->name_in_schema = explode(" ", $user->complete_name)[0];
            $nonMember->email = $user->email;
            $nonMember->admin = 0;
            $nonMember->group_size = 1;
            $nonMember->connected = 0;
            $nonMembers->push($nonMember);
         } else {
            $member = V_MemberSchedule::where('user_id', $user->id)
                            ->where('schedule_id', $schedule->id)->first();  //Only one is possible
            $member->connected = 1;
            $nonMembers->push($member);
         }
      }
      $sortedNonMembers = $nonMembers->sortBy('user_name');
      $sortedNonMembers->values()->all();
      return view('schedule..admin.notConnectedMembers', [
          'schedule' => $schedule,
          'nonMembers' => $sortedNonMembers,
          'members' => $members,
          'currentUser' => Auth::user(),
          'names' => $this->names(),
          'admin' => Utility::getAdminForSchedule($scheduleId),
          'status' => $status
      ]);
   }

   // Show my schemas
   public function showAdminSchemas() {
      if (Auth::user()->authority > 1) {
         $myVMemberSchedules = collect([]);
         $schedules = Schedule::all();
         foreach ($schedules as $mySchedule) {
            $mySchedule->schedule_id = $mySchedule->id;
            $mySchedule->schedule_name = $mySchedule->name;
            $mySchedule->schedule_description = $mySchedule->description;
            $myVMemberSchedules->push($mySchedule);
         }
      } else {
         $myVMemberSchedules = V_MemberSchedule::where('user_id', Auth::id())->where('admin', '>', 0)->get();
      }
      //$myScheduleIds = $myVMemberSchedules->pluck('schedule_id');
      foreach ($myVMemberSchedules as $myVMemberSchedule) {
         $myVMemberSchedule->admins = V_MemberSchedule::where('schedule_id', $myVMemberSchedule->schedule_id)
                         ->where('admin', 1)
                         ->get()->implode('user_name', ',');
         $myVMemberSchedule->isAdmin = V_MemberSchedule::where('schedule_id', $myVMemberSchedule->schedule_id)
                         ->where('admin', 1)->where('user_id', Auth::id())
                         ->get()->count();
      }
      return view('schedule.admin.adminSchemas', [
          'myVMemberSchedules' => $myVMemberSchedules,
          'names' => $this->names()
      ]);
   }

   // Show my schemas
   public function showMySchemas() {
      $myVMemberSchedules = V_MemberSchedule::where('user_id', Auth::id())->get();
      foreach ($myVMemberSchedules as $myVMemberSchedule) {
         $myVMemberSchedule->admins = V_MemberSchedule::where('schedule_id', $myVMemberSchedule->schedule_id)
                         ->where('admin', 1)
                         ->get()->implode('user_name', ',');
      }

      return view('schedule.mySchemas', [
          'myVMemberSchedules' => $myVMemberSchedules,
          'names' => $this->names()
      ]);
   }


// Show view AdminComments
   public function showViewAdminComments($scheduleId) {

// $schedule = Schedule::find($scheduleId);
      $mytime = Carbon::now();
      $today = $mytime->toDateString();
//      $vMemberScheduleDates = V_MemberScheduleDate::where('schedule_date', '>=', $today)->get();
      $schedule = Schedule::find($scheduleId);
      $scheduleDates = ScheduleDate::where('schedule_id', $scheduleId)
              ->where('schedule_date', '>=', $today)
              ->get();
      return view('schedule.admin.comments', [
          'schedule' => $schedule,
          'currentUser' => Auth::user(),
          'scheduleDates' => $scheduleDates,
          'names' => $this->names(),
          'admin' => Utility::getAdminForSchedule($scheduleId)
      ]);
   }

// Show view SchemaEdit for updating the member's attendance status
   public function showViewEdit(Schedule $schedule) {

      $mytime = Carbon::now();
      $today = $mytime->toDateString();
      $vMemberScheduleDates = V_MemberScheduleDate::where('schedule_date', '>=', $today)->get();
      $scheduleDates = ScheduleDate::where('schedule_id', $schedule->id)
              ->where('schedule_date', '>=', $today)
              ->get();
      $statuses = array();
      foreach ($scheduleDates as $scheduleDate) {
         $memberSchedulesForDate = $vMemberScheduleDates
                 ->where('schedule_date', $scheduleDate->schedule_date)
                 ->where('user_id', Auth::user()->id)
                 ->all();
         foreach ($memberSchedulesForDate as $memberScheduleForDate) {
            $statuses[$scheduleDate->id] = $memberScheduleForDate->status;
         }
      }
      $memberSchedule= MemberSchedule::where('schedule_id', $schedule->id)
              ->where('user_id', Auth::user()->id)
              ->first();

      ;
      return view('schedule.schemaEdit', [
          'schedule' => $schedule,
          'memberSchedule' => $memberSchedule,
          'currentUser' => Auth::user(),
          'scheduleDates' => $scheduleDates,
          'names' => $this->names(),
          'statuses' => $statuses, // TODO: Only the statuses of the current user is needed
      ]);
   }
   

//Updating the member's attendance status
   public function updateAttendance(Request $request) {
      $data = request()->all();
      $scheduleId = 0;
      foreach ($data as $key => $value) {
         if (substr($key, 0, 6) === 'status') {
            $atoms = explode('_', $key);
            $userId = $atoms[1];
            $scheduleDateId = $atoms[2];
            $memberScheduleDate = MemberScheduleDate::where('user_id', $userId)
                    ->where('schedule_date_id', $scheduleDateId)
                    ->first();
            $memberScheduleDate->status = $value;
            $memberScheduleDate->save();
         } else if (substr($key, 0, 10) === 'scheduleId') {
            $scheduleId = $value;
         }
      }
      return redirect(route('schedule.index', ['scheduleId' => $scheduleId]));
   }

// Update comemnts for one or more dates
   public function updateComments(Request $request) {
      $data = request()->all();
      $scheduleId = 0;
      foreach ($data as $key => $value) {
         if (substr($key, 0, 7) === 'comment') {
            $atoms = explode('_', $key);
            $scheduleDateId = $atoms[1];
            $scheduleDate = ScheduleDate::find($scheduleDateId);
            $scheduleDate->comment = $value;
            $scheduleDate->save();
         } else if (substr($key, 0, 10) === 'scheduleId') {
            $scheduleId = $value;
         }
      }
      $schedule = Schedule::find($scheduleId);
// return redirect(route('admin.showMenu',['schedule' =>$schedule]));
      return redirect(route('schedule.index', ['scheduleId' => $schedule->id]));
   }

   public function welcome() {
      $vMemberSchedules = V_MemberSchedule::where('user_id', Auth::user()->id)->get();
      $count = $vMemberSchedules->count();

      return view('schedule.welcome', [
          'mySchedulesCount' => $count,
          'names' => $this->names(),
          'vMemberSchedules' => $vMemberSchedules
      ]);
   }

}
