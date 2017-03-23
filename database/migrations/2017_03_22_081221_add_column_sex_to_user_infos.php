<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSexToUserInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_infos', function($table)
        {
          $table->string('sex')->after('tel');
        });
    }

   /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::table('user_infos', function($table){
          $table->dropColumns('sex');
      });
    }
}
