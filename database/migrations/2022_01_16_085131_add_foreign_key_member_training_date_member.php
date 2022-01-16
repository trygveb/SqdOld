<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyMemberTrainingDateMember extends Migration
{
 private $FK_NAME='member_training_date_FK_1';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sdSchema.member_training_date', function (Blueprint $table) {
            $table->foreign('user_id',$this->FK_NAME)->references('id')->on('sqd.users')->onUpdate('CASCADE')->onDelete('CASCADE');
        
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sdSchema.member_training_date', function (Blueprint $table) {
           $table->dropForeign($this->FK_NAME);
        
        });
    }
}