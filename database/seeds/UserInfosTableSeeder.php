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
      'first_name' => '小松',
      'last_name' => '信之',
      'email' => 'hoge@gmail.com',
      'tel' => 11111111,
      'store_id' => 1,
    ]);
    UserInfos::create(
    [
      'first_name' => '池田',
      'last_name' => '篤史',
      'email' => 'fuga@gmail.com',
      'tel' => 222222222,
      'store_id' => 2,
    ]);
    UserInfos::create(
    [
      'first_name' => '河原',
      'last_name' => '佑哉',
      'email' => 'hogefuga@gmail.com',
      'tel' => 333333333,
      'store_id' => 3,
    ]);
    }
  }
}
