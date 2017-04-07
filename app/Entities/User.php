<?php
namespace App\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

// class User extends Model implements Transformable
class User extends Authenticatable implements Transformable
{
  use TransformableTrait;
  // use Authenticatable;

  protected $fillable = [
    'name',
    'password',
    'usre_info_id',
  ];

  protected $hidden = [
        'password', 'remember_token',
    ];

  public function info()
  {
    return $this->hasOne('App\Entities\UserInfos', 'id' ,'user_info_id');
    // return $this->belongsTo('App\Entities\UserInfos', 'user_info_id', 'id');
  }

  public function dailyReport(){
    return $this->hasMany('App\Entities\DailyReports', 'user_id');
  }
}
