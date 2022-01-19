<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAdminToMemberTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sdSchema')->table('member_training', function (Blueprint $table) {
         $table->unsignedTinyInteger('admin')->default(0)->after('training_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('sdSchema')->table('member_training', function (Blueprint $table) {
            $table->dropColumn('admin');
        });
    }
}
