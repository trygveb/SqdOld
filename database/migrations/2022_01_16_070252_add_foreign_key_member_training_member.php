<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyMemberTrainingMember extends Migration
{
   private $FK_NAME='member_training_FK_0';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sdSchema.member_training', function (Blueprint $table) {
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
        Schema::table('sdSchema.member_training', function (Blueprint $table) {
           $table->dropForeign($this->FK_NAME);
        
        });
    }
}
