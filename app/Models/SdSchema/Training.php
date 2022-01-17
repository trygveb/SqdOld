<?php

namespace App\Models\SdSchema;

use Illuminate\Database\Eloquent\Model;

class Training extends Model {

   protected $connection = 'sdSchema';
   protected $table = 'training';

   public function trainingDates() {
      return $this->hasMany(TrainingDate::class);
   }

}
