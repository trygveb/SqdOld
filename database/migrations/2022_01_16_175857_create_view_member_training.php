<?php

use Illuminate\Database\Migrations\Migration;

class CreateViewMemberTraining extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE OR REPLACE VIEW `sdSchema`.`v_member_training` AS select
      `u`.`id` AS `user_id`,
      `u`.`name` AS `user_name`,
      `t`.`id` AS `training_id`,
      `t`.`name` AS `training_name`,
      `g`.`size` AS `group`,
      `u`.`email` AS `email`
        from`sdSchema`.`member_training` `mt`
        left join `sdSchema`.`training` `t` on `t`.`id` = `mt`.`training_id`
        left join `sqd`.`users` `u` on `u`.`id` = `mt`.`user_id`
        left join `sdSchema`.`groupsize` `g` on `u`.`id` = `g`.`user_id`
     ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS `sdSchema`.`v_member_training`');
    }
}
