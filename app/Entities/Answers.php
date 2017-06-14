<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answers extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $fillable = [
        'user_id',
        'question_id',
        'content',
    ];

    protected $dates = ['deleted_at'];

}
