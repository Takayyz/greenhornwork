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

    public function user() {
      return $this->belongsTo('App\Entities\User');
    }

    public function scopeWhereName($query, $field, $name) {
      if(!$field || !$name){
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
}
