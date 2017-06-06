<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Items extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $fillable = [
      'item_category_id',
      'name',
      'item_info',
    ];

    protected $dates = ['deleted_at'];

    public function category()
    {
      return $this->belongsTo('App\Entities\ItemCategory', 'item_category_id');
    }
}
