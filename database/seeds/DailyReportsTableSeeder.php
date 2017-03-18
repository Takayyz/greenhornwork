<?php

use Illuminate\Database\Seeder;

class DailyReportsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('daily_reports')->truncate();

        DB::table('daily_reports')->insert([
            [
                'user_id' => 1,
                'title' => '初日',
                'contents' => '研修初日でした。',
                'reporting_time' => '2017-03-15',
            ],
            [
                'user_id' => 2,
                'title' => '二日目',
                'contents' => '2日目の研修でした',
                'reporting_time' => '2017-03-16',
            ],
        ]);
    }
}
