<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\Connections;

class RenameUserColumns extends Migration
{
   use Connections;
   
    public function up()
    {
       $myConnection = Connections::laravel_connection();
      DB::connection($myConnection)->statement("ALTER TABLE users RENAME COLUMN name TO old_name");
      DB::connection($myConnection)->statement("ALTER TABLE users RENAME COLUMN complete_name TO name");
       
       
      Schema::connection($myConnection)->table('users', function (Blueprint $table) {
            $table->dropColumn('old_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $myConnection=Connections::laravel_connection();
      DB::connection($myConnection)->statement("ALTER TABLE laravel.users CHANGE name complete_name  varchar(72)  AS"
                . " (CONCAT(first_name,' ', COALESCE(middle_name,''), ' ', family_name))");
     // DB::statement("ALTER TABLE laravel.users CHANGE old_name name  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
      Schema::connection($myConnection)->table('users', function (Blueprint $table) {
            $table->string('name', 24)->after('id');
        });


    }
}
