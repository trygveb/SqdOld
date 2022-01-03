<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMemberTrainingDateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::connection('sdSchema')->create('member_training_date', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('training_date_id');
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamps();
            
            $table->foreign('user_id', 'member_training_date_FK_1')->references('id')->on('sqd.users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('training_date_id', 'member_training_date_FK_2')->references('id')->on('training_date')->onDelete('cascade')->onUpdate('cascade');
        });
        DB::connection('sdSchema')->statement("ALTER TABLE `member_training_date` comment='This table contains the status for each member on each training date'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('sdSchema')->dropIfExists('member_training_date');
    }
}
