<?php

use Illuminate\Database\Seeder;
use App\Entities\DailyReports;
use Carbon\Carbon;

class DailyReportsTableSeeder extends Seeder
{

    public function run()
    {
        DailyReports::truncate();
        DailyReports::create(
            [
                'user_id' => 1,
                'title' => '初日',
                'contents' => '研修初日でした。',
                'reporting_time' => Carbon::create('2017','3','20'),
            ]);
    }
}
