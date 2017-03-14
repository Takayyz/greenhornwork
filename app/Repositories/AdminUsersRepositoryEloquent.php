<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AdminUsersRepository;
use App\Entities\AdminUsers;
use App\Validators\AdminUsersValidator;

/**
 * Class AdminUsersRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AdminUsersRepositoryEloquent extends BaseRepository implements AdminUsersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminUsers::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
