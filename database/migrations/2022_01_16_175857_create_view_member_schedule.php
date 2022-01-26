<?php

use Illuminate\Database\Migrations\Migration;

class CreateViewMemberSchedule extends Migration
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
      DB::statement('CREATE OR REPLACE VIEW `schedule`.`v_member_schedule` AS
         select
             `u`.`id` AS `user_id`,
             `u`.`name` AS `user_name`,
             `u`.`email` AS `email`,
             `t`.`id` AS `schedule_id`,
             `t`.`name` AS `schedule_name`,
             `t`.`description` AS `schedule_description`,
             `t`.`password` AS `password`,
             `mt`.`group_size` AS `group_size`,
             `mt`.`admin` AS `admin`
         from
             ((`schedule`.`member_schedule` `mt`
         left join `schedule`.`schedule` `t` on
             ((`t`.`id` = `mt`.`schedule_id`)))
         left join `'.$laravelDatabase.'`.`users` `u` on
             ((`u`.`id` = `mt`.`user_id`)))');
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
