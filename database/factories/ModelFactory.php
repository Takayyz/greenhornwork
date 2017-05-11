<?php
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Entities\Stores::class, function(Faker\Generator $faker) {
    return [
      'name' => $faker->firstName,
      'kana_name' => $faker->firstName
    ];
});


$factory->define(App\Entities\UserInfos::class, function(Faker\Generator $faker) {
    static $phoneNumber = 11111111;
    $storeIndex = mt_rand(1, 3);
    $accessRightValue = mt_rand(0, 7);
    $position_names = ['部長', '課長', '開発者', '一般社員'];
    $position_codes = [25, 50, 75, 100];
    $position_index = mt_rand(0, 3);
    return [
      'first_name' => $faker->firstName,
      'last_name' => $faker->lastName,
      'email' => $faker->unique()->safeEmail,
      'tel' => $phoneNumber++,//$faker->phoneNumber,
      'hire_date' => $faker->dateTime,
      'birthday' => $faker->dateTime,
      'sex' => (mt_rand(0, 1) === 0) ? '男' : '女',
      'store_id' => $storeIndex,
      'access_right' => $accessRightValue,
      'position_name' => $position_names[$position_index],
      'position_code' => $position_codes[$position_index]
    ];
});


$factory->define(App\Entities\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => null,//str_random(10),
        'user_info_id' => factory(App\Entities\UserInfos::class)->create()->id
    ];
});

$factory->define(App\Entities\DailyReports::class, function (Faker\Generator $faker) {
  return [
    'user_id' => factory(App\Entities\User::class)->create()->id,
    'title' => "Some Title",
    'contents' => "Some contents...",
    'reporting_time' => $faker->dateTime
  ];
});
