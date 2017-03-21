<?php
namespace App\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  protected $fillable = [
    'name',
    'password',
    'usre_info_id',
  ];
  
  protected $hidden = [
        'password', 'remember_token',
    ];
}
