<?php

use Illuminate\Database\Seeder;
use App\Entities\UserInfos;

class UserInfosTableSeeder extends Seeder
{

    public function run()
    {
        UserInfos::truncate();
        UserInfos::create([
          'first_name' => "Atsushi",
          'last_name' => "Ikeda",
          'email' => "sample@sample.com",
          'tel' => 1234567890,
          'store_id' => 1,
        ]);
          // DB::table('user_infos')->insert([
          //   'first_name' => 'test',
          //   'last_name' => 'test',
          //   'email' => 'sample@sample.com',
          //   'tel' => 09012345678,
          //   'store_id' => 1,
          // ]);
    }
}
