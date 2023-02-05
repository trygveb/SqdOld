<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexMemberScheduleUX2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('schedule.member_schedule', function (Blueprint $table) {
          $table->unique(['schedule_id', 'name_in_schema'], "member_schedule_UX_2");
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('schedule.member_schedule', function (Blueprint $table) {
        $table->dropUnique('member_schedule_UX_2');
      });
    }
}
