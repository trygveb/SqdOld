<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameUserColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
   //   DB::statement("ALTER TABLE laravel.users CHANGE name old_name varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
      DB::statement("ALTER TABLE laravel.users CHANGE complete_name name varchar(72)  AS"
                . " (CONCAT(first_name,' ', COALESCE(middle_name,''), ' ', family_name))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::statement("ALTER TABLE laravel.users CHANGE name complete_name  varchar(72)  AS"
                . " (CONCAT(first_name,' ', COALESCE(middle_name,''), ' ', family_name))");
     // DB::statement("ALTER TABLE laravel.users CHANGE old_name name  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
      Schema::table('users', function (Blueprint $table) {
            $table->string('name', 24)->after('id');
        });


    }
}
