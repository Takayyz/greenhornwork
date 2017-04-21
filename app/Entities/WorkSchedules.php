<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class WorkSchedules extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    public $updateDir = 'schedules/';

    protected $fillable = [
        'user_id',
        'file_path',
        'file_name',
        'file_type',
        'year',
        'month',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
      return $this->belongsTo('App\Entities\User');
    }

    public function scopeWhereUserId($query, $userId = NULL)
    {
      if(!isset($userId)) {
        return $query;
      }
      return $query->where('user_id', $userId);
    }

    public function scopeWhereDate($query, $field, $date)
    {
      if(!$field || !$date){
        return $query;
      }
      switch($field) {
        case 'year':
        case 'month':
          return $query->where($field, $date);
          break;
        default:
          return $query;
      }
    }

    //年月が一致するデータで絞る
    public function scopeDateRange($query, $input)
    {
      //年月の両方が未入力の場合は何もしない
      if(!isset($input['year']) && !isset($input['month'])) {
        return $query;
      }
      $fields = ['year', 'month'];
      foreach($fields as $field) {
        $query->WhereDate($field, $input[$field]);
      }
    }

    //苗字、名前が一致するデータで絞る
    public function scopeUserInfo($query, $input)
    {
      //苗字、名前の両方が未入力の場合は何もしない
      if(!isset($input['first_name']) && !isset($input['last_name'])){
        return $query;
      }
      return $query->whereHas('user', function($query) use ($input) {
        return $query->whereHas('info', function ($query) use ($input) {
          $fields = ['first_name', 'last_name'];
          foreach($fields as $field) {
            $query->whereName($field, $input[$field]);
          }
        });
      });
    }

}
