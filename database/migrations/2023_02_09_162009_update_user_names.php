<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\Connections;

class UpdateUserNames extends Migration {

   use Connections;

   public function up() {
      $myConnection = Connections::laravel_connection();

      DB::connection($myConnection)->statement("UPDATE users SET first_name='Arne',family_name='Gustavsson'	WHERE id=2;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='Georg',family_name='Hodosi'	WHERE id=5;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='Trygve',family_name='Botnen'	WHERE id=6;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='Leif',family_name='Håkansson'	WHERE id=9;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='Göran',family_name='Olsbro'	WHERE id=13;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='Vigdis',family_name='Tengelsen'	WHERE id=14;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='Eva',family_name='Vagnkilde'	WHERE id=15;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='Annika',family_name='Myhrberg'	WHERE id=16;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='Lars',family_name='Rawet'	WHERE id=17;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='Monica',family_name='Taleryd'	WHERE id=18;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='Inge',family_name='Pettersson'	WHERE id=19;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='Michel',family_name='Quetel'	WHERE id=25;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='Monika',family_name='Lykvist'	WHERE id=26;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='Helene',family_name='Botnen'	WHERE id=27;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='LAsse',family_name='Jägdahl'	WHERE id=28;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='Tomas',family_name='Andersson'	WHERE id=30;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='Jesper',family_name='Svensson'	WHERE id=32;");
      DB::connection($myConnection)->statement("UPDATE users SET first_name='Lena',family_name='Jonsson'	WHERE id=33;");
      DB::connection($myConnection)->statement("ALTER TABLE users CHANGE name old_name varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
      DB::connection($myConnection)->statement("ALTER TABLE users CHANGE complete_name name varchar(72) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci GENERATED ALWAYS AS (concat(`first_name`,_utf8mb4\' \',coalesce(`middle_name`,_utf8mb4\'\'),_utf8mb4\' \',`family_name`)) VIRTUAL NULL;");
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      //
   }

}
