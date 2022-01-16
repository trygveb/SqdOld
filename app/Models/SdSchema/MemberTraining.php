<?php

namespace App\Models\SdSchema;

use Illuminate\Database\Eloquent\Model;

// This is a many-to-many relationship connecting members and trainings
// One member can attend many trainings
// OnE training has many members
class MemberTraining extends Model {

   protected $connection = 'sdSchema';
   protected $table = 'member_training';
   protected $fillable = [
       'user_id',
       'training_id',
   ];

}
