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

    public function scopeDateRange($query, $start_date, $end_date){
      return $query->whereBetween('reporting_time', [$start_date, $end_date]);
    }
}
