<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemCategory extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $fillable = [
      'category',
    ];

    protected $dates = ['deleted_at'];

}
