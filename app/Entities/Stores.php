<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Stores extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected $dates = ['deleted_at'];

}
