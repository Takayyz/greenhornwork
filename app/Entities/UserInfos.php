<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserInfos extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'sex',
        'birthday',
        'email',
        'tel',
        'store_id',
    ];

    protected $dates = ['deleted_at'];

    public function store () 
    {
        return $this->belongsTo('App\Entities\Stores');
    }
}
