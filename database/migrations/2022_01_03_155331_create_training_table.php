<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sdSchema')->create('training', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20)->unique();
            $table->string('comment', 250)->nullable();
            $table->timestamps();
        });
        DB::connection('sdSchema')->statement("ALTER TABLE `training` comment='This table should contain a (unique) name for each training/course'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('sdSchema')->dropIfExists('training');
    }
}
