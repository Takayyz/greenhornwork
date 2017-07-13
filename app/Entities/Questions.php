<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use cebe\markdown\Markdown;

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

    public function category()
    {
      return $this->belongsTo('App\Entities\TagCategory', 'tag_category_id');
    }

    public function parse()
    {
        $parser = new Markdown();

        return $parser->parse($this->content);
    }

    public function getMarkContentAttribute()
    {
        return $this->parse();
    }

}
