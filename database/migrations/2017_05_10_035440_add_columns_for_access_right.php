<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsForAccessRight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('user_infos', function($table) {
        $table->integer('access_right')->after('store_id')->nullable();
        $table->integer('position_code')->after('access_right');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('user_infos', function($table) {
        $table->dropColumn('access_right');
        $table->dropColumn('position_code');
      });
    }
}
