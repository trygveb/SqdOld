<?php

use Illuminate\Database\Migrations\Migration;
//use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Support\Facades\Schema;

class ModifyViewMemberScheduleDate extends Migration
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
         `msd`.`user_id` AS `user_id`,
         `msd`.`schedule_date_id` AS `schedule_date_id`,
         `msd`.`status` AS `status`,
         `vms`.`user_name` AS `user_name`,
         `vms`.`schedule_id` AS `schedule_id`,
         `vms`.`group_size` AS `group_size`,
         `sd`.`schedule_date` AS `schedule_date`
     from
         (((`member_schedule_date` `msd`
     left join `v_member_schedule` `vms` on
         ((`vms`.`user_id` = `msd`.`user_id`)))
     left join `schedule_date` `sd` on
         ((`sd`.`id` = `msd`.`schedule_date_id`)))
     left join `'.$laravelDatabase.'`.`users` `u` on
         ((`u`.`id` = `msd`.`user_id`)))
     ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection('schedule')->statement('DROP VIEW IF EXISTS `v_member_schedule_date`');
    }
}
