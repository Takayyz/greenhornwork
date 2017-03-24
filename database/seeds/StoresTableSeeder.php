<?php

use Illuminate\Database\Seeder;
use App\Entities\Stores;

class StoresTableSeeder extends Seeder
{
  public function run()
  {
    Stores::truncate();
    Stores::create([
      'name' => '新宿店',
      'kananame' => 'シンジュクテン',
    ]);
    Stores::create([
      'name' => '渋谷店',
      'kananame' => 'シブヤテン',
    ]);
    Stores::create([
      'name' => '池袋店',
      'kananame' => 'イケブクロテン',
    ]);
  }
}
