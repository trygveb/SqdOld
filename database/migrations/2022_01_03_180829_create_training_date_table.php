<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTrainingDateTable extends Migration {

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::connection('sdSchema')->create('training_date', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('training_id');
         $table->date('training_date');
         $table->time('start_time')->default('19:00:00');
         $table->string('comment', 250)->nullable();
         $table->timestamps();
         $table->foreign('training_id', 'training_date_FK')->references('id')->on('training')->onDelete('cascade')->onUpdate('cascade');
      });
      DB::connection('sdSchema')->statement("ALTER TABLE `training_date` comment='This table contains all dates for all trainings, with start-time and comment'");
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::connection('sdSchema')->dropIfExists('training_date');
   }

}
