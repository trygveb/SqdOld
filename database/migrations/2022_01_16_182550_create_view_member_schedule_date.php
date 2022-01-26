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
      DB::connection('schedule')->statement('CREATE OR REPLACE VIEW `v_member_schedule_date` AS select
         `mtd`.`user_id` AS `user_id`,
         `vmt`.`user_name` AS `user_name`,
         `mtd`.`schedule_date_id` AS `schedule_date_id`,
         `td`.`schedule_date` AS `schedule_date`,
         `mtd`.`status` AS `status`,
         `vmt`.`group_size` AS `group_size`
     from
         (((`member_schedule_date` `mtd`
     left join `v_member_schedule` `vmt` on
         ((`vmt`.`user_id` = `mtd`.`user_id`)))
     left join `schedule_date` `td` on
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
        DB::connection('schedule')->statement('DROP VIEW IF EXISTS `v_member_schedule`');
    }
}
