<?php

namespace App\Actions;

use App\Models\SdSchema\V_MemberTraining;


class CreateEmailListAction {

   public function execute($trainingId) {
     // $training= Training::find($trainingId);
      $vMemberTrainings= V_MemberTraining::where('training_id', $trainingId)->get();
      $emails= array();
      foreach ($vMemberTrainings as $vMemberTraining) {
         array_push($emails, $vMemberTraining->email);
      }
      return $emails;
   }

}
