<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameMemberColumnOnMemberTrainingTable extends Migration {

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      DB::statement('ALTER TABLE sdSchema.member_training CHANGE member_id user_id bigint unsigned NOT NULL');
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      DB::statement('ALTER TABLE sdSchema.member_training CHANGE user_id member_id bigint unsigned NOT NULL');
   }

}
