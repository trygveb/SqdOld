<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorUserNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name', 24)->nullable()->after('name');
            $table->string('middle_name', 24)->nullable()->after('first_name');
            $table->string('family_name', 24)->nullable()->after('middle_name');
            $table->string('complete_name', 72)->storedAs("CONCAT(first_name,' ',middle_name, ' ', family_name)")->nullable()->after('family_name');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users', function (Blueprint $table) {
         $table->dropColumn('complete_name');
         $table->dropColumn(['first_name', 'middle_name', 'family_name']);
      });
    }
}
