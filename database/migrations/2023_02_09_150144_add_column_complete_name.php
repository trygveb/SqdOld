<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCompleteName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE users ADD complete_name varchar(72)  AS"
                . " (CONCAT(first_name,' ', COALESCE(middle_name,''), ' ', family_name)) AFTER name");

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
      });
    }
}
