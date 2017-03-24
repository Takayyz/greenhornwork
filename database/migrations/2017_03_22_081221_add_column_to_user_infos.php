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
          $table->timestamp('birthday')->after('sex');
          $table->timestamp('hire_date')->after('birthday');
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
