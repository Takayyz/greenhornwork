<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class UsersTableSeeder extends Seeder
{
  public function run()
  {
    User::truncate();
    User::create([
      'name' => 'test',
      'password' => bcrypt('1234'),
      'user_info_id'=>'1'
    ]);
  }
}
