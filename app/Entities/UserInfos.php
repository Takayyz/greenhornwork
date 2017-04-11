<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserInfos extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'sex',
        'birthday',
        'email',
        'tel',
        'hire_date',
        'store_id'
    ];

    protected $dates = ['deleted_at'];

    public function store ()
    {
        return $this->belongsTo('App\Entities\Stores');
    }

    public function user()
    {
      return $this->hasOne('App\Entities\User','user_info_id');
    }

    public function scopeWhereName($query, $field, $name)
    {
      if (!$field || !$name) {
        return $query;
      }
      switch($field) {
        case 'first_name':
        case 'last_name':
          return $query->where($field, 'like', $name);
          break;
        default:
          return $query;
      }
    }

    /**
     * 指定されたDBのコラムを取得。
     * データが空であれば処理なし。
     */
    public function scopeEqual($query, $field, $data)
    {

      //　fieldまたはnameに情報が入っていなければ、処理を終了。
      if(!$field || !$data) {
        return $query;
      }

      //　fieldの値がemail, tel, sex以外は処理しない。
      switch($field) {
        case 'email':
        case 'tel':
        case 'sex':
          return $query->where($field, $data);
          break;
        default:
          return $query;
      }
    }

    /**
     * データを範囲で指定し、ユーザーインフォ情報を取得。
     * データが空であれば処理なし。
     */
    public function scopeDateRange($query, $field, $start_date, $end_date) {
      if (!$field || (!$start_date && !$end_date)) {
        return $query;
      }

      switch($field) {
        case 'birthday':
        case 'hire_date':
          if ($start_date) {
            $query->where($field, '>=', date($start_date));
          }
          if ($end_date) {
            $query->where($field, '<=', date($end_date));
          }
          return $query;
          break;
        default:
          return $query;
      }
    }
}
