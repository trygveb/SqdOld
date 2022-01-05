<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMemberTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sdSchema')->create('member_training', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('training_id');
            $table->timestamps();
//            $table->foreign('member_id', 'member_training_FK_1')->references('id')->on('sqd.users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('training_id', 'member_training_FK_2')->references('id')->on('training')->onDelete('cascade')->onUpdate('cascade');
        });
         DB::connection('sdSchema')->statement("ALTER TABLE `member_training` comment='This is a many-to-many relationship connecting members and trainings'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('sdSchema')->dropIfExists('member_training');
    }
}
