<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Entities\Items;

class ItemCategory extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $fillable = [
      'category',
    ];

    protected $dates = ['deleted_at'];

    public function item()
    {
      return $this->belongsTo(Items::class, 'id', 'item_category_id');
    }
}
