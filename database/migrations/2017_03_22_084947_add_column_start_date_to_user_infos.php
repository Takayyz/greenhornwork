<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStartDateToUserInfos extends Migration
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
          $table->string('start_date')->after('tel');
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
          $table->dropColumns('start_date');
      });
    }
}

