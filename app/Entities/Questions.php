<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questions extends Model implements Transformable
{
    use TransformableTrait,SoftDeletes;

    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content',
    ];

    protected $dates = ['deleted_at'];

}
