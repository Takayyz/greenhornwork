<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnYearMonthToWorkScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('work_schedules', function($table)
      {
        $table->string('year')->after('file_type');
        $table->string('month')->after('year');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('work_schedules', function($table)
      {
        $table->dropColumn('year_month');
      });
    }
}
