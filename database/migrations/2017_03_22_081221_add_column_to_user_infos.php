<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToUserInfos extends Migration
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
          $table->timestamp('birthday')->after('tel')->nullable();
          $table->timestamp('hire_date')->after('tel')->nullable();
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
          $table->dropColumn('sex');
          $table->dropColumn('birthday');
          $table->dropColumn('hire_date');
      });
    }
}
