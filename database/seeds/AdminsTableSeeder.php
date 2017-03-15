<?php

use Illuminate\Database\Seeder;
use App\Entities\AdminUsers;

class AdminsTableSeeder extends Seeder
{
  public function run()
  {
    AdminUsers::truncate();
    AdminUsers::create([
      'name' => 'admin',
      'password' => bcrypt('1234'),
      'info_id' => 1,
      'privileges' => 1,
    ]);
  }
}
