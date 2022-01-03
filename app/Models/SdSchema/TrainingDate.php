<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// This table contains all dates for all trainings, with start-time and comment
class TrainingDate extends Model {

   protected $connection = 'sdSchema';
   protected $table = 'training_date';
   protected $fillable = [
       'training_date',
   ];

}
