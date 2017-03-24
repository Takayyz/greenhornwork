<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserInfosRepository;
use App\Entities\UserInfos;
use App\Validators\UserInfosValidator;

/**
 * Class UserInfosRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserInfosRepositoryEloquent extends BaseRepository implements UserInfosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserInfos::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getUserList($id)
    {
      return UserInfos::where('store_id', $id)->get();
    }
}
