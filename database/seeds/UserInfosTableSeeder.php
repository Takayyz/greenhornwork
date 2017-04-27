<?php

use Illuminate\Database\Seeder;
use App\Entities\UserInfos;

class UserInfosTableSeeder extends Seeder
{
  public function run()
  {
    UserInfos::truncate();
    {
    UserInfos::create(
      [
      'first_name' => '信之',
      'last_name' => '小松',
      'email' => 'hoge@gmail.com',
      'tel' => 11111111,
      'sex' => '男',
      'store_id' => 1,
    ]);
    UserInfos::create(
    [
      'first_name' => '篤史',
      'last_name' => '池田',
      'email' => 'fuga@gmail.com',
      'tel' => 222222222,
      'sex' => '男',
      'store_id' => 2,
    ]);
    UserInfos::create(
    [
      'first_name' => '佑哉',
      'last_name' => '河原',
      'email' => 'hogefuga@gmail.com',
      'tel' => 333333333,
      'sex' => '男',
      'store_id' => 3,
    ]);
    }
    //  UsersにDailyReportsのFactoryをおいている理由は、
    //  各Seederでtrancate関数を用いているため、正常な動作がしない。
    //  UserInfosTableは一番最後に実行するので差し当たりここに記述。
    factory(App\Entities\DailyReports::class, 20)->create();
  }
}
