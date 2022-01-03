<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// This is a many-to-many relationship, with the status for each member on each training date
class MemberTrainingDate extends Model
{
     protected $connection = 'sdSchema';
     protected $table = 'member_training_date';
        protected $fillable = [
       'user_id',
       'training_date_id',
   ];

}
