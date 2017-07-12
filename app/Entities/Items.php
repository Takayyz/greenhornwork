<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Entities\ItemCategory;

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
      return $this->belongsTo(ItemCategory::class, 'item_category_id');
    }
    public function scopeWhereName($query, $field, $name) {
      if(!$field || !$name)
      {
        return $query;
      }

      switch ($field) {
        case 'name':
          return $query->where($field, 'like', '%' . $name . '%');
          break;

        default:
          $query;
      }
    }
}
