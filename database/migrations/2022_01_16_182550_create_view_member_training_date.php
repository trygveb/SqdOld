<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewMemberTrainingDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
      DB::statement('CREATE OR REPLACE VIEW `sdSchema`.`v_member_training_date` AS select
         `mtd`.`user_id` AS `user_id`,
         `vmt`.`user_name` AS `user_name`,
         `mtd`.`training_date_id` AS `training_date_id`,
         `td`.`training_date` AS `training_date`,
         `mtd`.`status` AS `status`,
         `vmt`.`group` AS `group`
     from
         (((`sdSchema`.`member_training_date` `mtd`
     left join `sdSchema`.`v_member_training` `vmt` on
         ((`vmt`.`user_id` = `mtd`.`user_id`)))
     left join `sdSchema`.`training_date` `td` on
         ((`td`.`id` = `mtd`.`training_date_id`)))
     left join `sqd`.`users` `u` on
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
        DB::statement('DROP VIEW IF EXISTS `sdSchema`.`v_member_training`');
    }
}
