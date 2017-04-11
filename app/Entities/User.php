<?php
namespace App\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

// class User extends Model implements Transformable
class User extends Authenticatable implements Transformable
{
  use TransformableTrait,
      SoftDeletes;
  // use Authenticatable;

  protected $fillable = [
    'name',
    'password',
    'user_info_id',
  ];

  protected $hidden = [
        'password', 'remember_token',
  ];

  public function info()
  {
    return $this->belongsTo('App\Entities\UserInfos', 'user_info_id');
    // return $this->belongsTo('App\Entities\UserInfos', 'user_info_id', 'id');
  }

  public function dailyReport()
  {
    return $this->hasMany('App\Entities\DailyReports', 'user_id');
  }

  /**
   * ユーザー名で検索
   * データが空であれば処理なし。
   */
  public function scopeWhereName($query, $field, $name)
  {
    //　fieldまたはnameに情報が入っていなければ、処理を終了。
    if(!$field || !$name) {
      return $query;
    }

    //　fieldの値がname以外は処理しない。
    switch($field) {
      case 'name':
        return $query->where($field, 'like', '%' . $name . '%');
        break;
      default:
        return $query;
    }
  }
}
