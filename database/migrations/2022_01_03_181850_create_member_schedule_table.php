<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMemberScheduleTable extends Migration {

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::connection('schedule')->create('member_schedule', function (Blueprint $table) {
         $env = env('APP_ENV', 'test');
         $table->id();
         $table->unsignedBigInteger('user_id');
         $table->unsignedBigInteger('schedule_id');
         $table->unsignedTinyInteger('group_size')->default(1);
         $table->unsignedTinyInteger('admin')->default(0);
         $table->timestamps();
         $table->unique(['user_id', 'schedule_id'],'member_schedule_UN_1');
         if ($env === 'test') {
            $table->foreign('user_id', 'member_schedule_FK_1')->references('id')->on('laravelTest.users')->onDelete('cascade')->onUpdate('cascade');
         } else {
            $table->foreign('user_id', 'member_schedule_FK_1')->references('id')->on('laravel.users')->onDelete('cascade')->onUpdate('cascade');
         }
         $table->foreign('schedule_id', 'member_schedule_FK_2')->references('id')->on('schedule')->onDelete('cascade')->onUpdate('cascade');
      });
      DB::connection('schedule')->statement("ALTER TABLE `member_schedule` comment='This is a many-to-many relationship connecting members and schedules'");
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::connection('schedule')->dropIfExists('member_schedule');
   }

}
