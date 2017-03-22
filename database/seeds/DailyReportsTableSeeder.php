<?php

use Illuminate\Database\Seeder;
use App\Entities\DailyReports;

class DailyReportsTableSeeder extends Seeder
{

    public function run()
    {
        // DB::table('daily_reports')->truncate();
        DailyReports::truncate();

        // DB::table('daily_reports')->create([
        DailyReports::create(
            [
                'user_id' => 1,
                'title' => '初日',
                'contents' => '研修初日でした。',
                'reporting_time' => '2017-03-15 00:00:00',
            ]);
    }
}
