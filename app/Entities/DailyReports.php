<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class DailyReports extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'contents',
        'reporting_time',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
      return $this->belongsTo('App\Entities\User');
    }

    /**
     * データを範囲で検索し、日報の情報を絞る。
     * データが空であれば処理なし。
     */
    public function scopeDateRange($query, $field, $start_date, $end_date) {
      if (!$field || (!$start_date && !$end_date)) {
        return $query;
      }

      switch($field) {
        case 'reporting_time':
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

    /**
     *　userIdで特定のユーザーを検索し、日報の範囲を絞る。
     *　userIdが空であれば処理なし。
     */
    public function scopeWhereUserId($query, $userId) {
      if(!$userId) {
        return $query;
      }
      return $query->where('user_id', $userId);
    }
}
