<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('katakana', function($attribute, $value, $parameters, $validator)
        {
          $regex = '{^(
            (\xe3\x82[\xa1-\xbf])
            |(\xe3\x83[\x80-\xbe])
          )+$}x';

          $result = preg_match($regex, $value, $match);
          if ($result == 1) {
            return true;
          }

          return false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
