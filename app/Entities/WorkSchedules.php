<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class WorkSchedules extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'user_id',
        'file_path',
        'file_type',
    ];

    protected $dates = ['deleted_at'];
}
