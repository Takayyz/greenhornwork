<?php

use Illuminate\Database\Seeder;
use App\Entities\AdminUsers;

class AdminUsersTableSeeder extends Seeder
{
  public function run()
  {
    AdminUsers::truncate();
    AdminUsers::create([
      'name' => 'admin',
      'password' => bcrypt('1234'),
      'privileges' => '1',
      'user_info_id'=>'1'
    ]);
  }
}
