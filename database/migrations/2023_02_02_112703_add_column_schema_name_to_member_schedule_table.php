<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSchemaNameToMemberScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       $laravel_connection=env('DB_DATABASE', 'laravel');
       $schedule_connection=env('DB_DATABASE_SCHEDULE', 'schedule');
        Schema::table($laravel_connection.'.member_schedule', function (Blueprint $table) {
            $table->string('name_in_schema', 12)->after('schedule_id');
        });
         DB::connection($schedule_connection)->statement('UPDATE member_schedule A
            INNER JOIN '.$laravel_connection.'.users B ON B.id = A.user_id
            SET A.name_in_schema = B.name');



    }
// 
// 
// 


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule.member_schedule', function (Blueprint $table) {
             $table->dropColumn('name_in_schema');
        });
    }
}
