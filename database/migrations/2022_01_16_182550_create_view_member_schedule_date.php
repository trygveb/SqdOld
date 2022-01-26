<?php

use Illuminate\Database\Migrations\Migration;
//use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Support\Facades\Schema;

class CreateViewMemberScheduleDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
      $env = env('APP_ENV', 'test');
      $laravelDatabase='laravel';
      if ($env==='test') {
         $laravelDatabase='laravelTest';
      }
      DB::statement('CREATE OR REPLACE VIEW `schedule`.`v_member_schedule_date` AS select
         `mtd`.`user_id` AS `user_id`,
         `vmt`.`user_name` AS `user_name`,
         `mtd`.`schedule_date_id` AS `schedule_date_id`,
         `td`.`schedule_date` AS `schedule_date`,
         `mtd`.`status` AS `status`,
         `vmt`.`group_size` AS `group_size`
     from
         (((`schedule`.`member_schedule_date` `mtd`
     left join `schedule`.`v_member_schedule` `vmt` on
         ((`vmt`.`user_id` = `mtd`.`user_id`)))
     left join `schedule`.`schedule_date` `td` on
         ((`td`.`id` = `mtd`.`schedule_date_id`)))
     left join `'.$laravelDatabase.'`.`users` `u` on
         ((`u`.`id` = `mtd`.`user_id`)))
     ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS `schedule`.`v_member_schedule`');
    }
}
