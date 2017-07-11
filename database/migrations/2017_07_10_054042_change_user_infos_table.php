<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
      Schema::table('user_infos', function ($table) {
        $table->string('userId')->nullable()->after('email');
        $table->string('tel')->nullable()->change();
        $table->string('sex')->nullable()->change();
        $table->integer('store_id')->nullable()->change();
        $table->integer('position_code')->nullable()->change();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
      Schema::table('user_infos', function ($table) {
        $table->dropColumn('userId');
        $table->string('tel')->change();
        $table->string('sex')->change();
        $table->integer('store_id')->change();
        $table->integer('position_code')->change();
      });
    }
}
