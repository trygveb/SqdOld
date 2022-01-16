<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsizeTable extends Migration
{
   
    private $FK_NAME='groupsize_FK_1';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sdSchema.groupsize', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedTinyInteger('size')->default(1);
            $table->timestamps();
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
        Schema::dropIfExists('groupsize');
    }
}
