<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
  public function run()
  {
    User::truncate();
    User::create([
      'name' => 'test',
      'password' => bcrypt('1234'),
    ]);
  }
}
