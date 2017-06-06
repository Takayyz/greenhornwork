<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RentInfosRepository;
use App\Entities\RentInfos;
use App\Validators\RentInfosValidator;

/**
 * Class RentInfosRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RentInfosRepositoryEloquent extends BaseRepository implements RentInfosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RentInfos::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAllRentInfos()
    {
        $rentInfos = $this->model->orderBy('rental_at')->get();

        return $rentInfos;
    }
}
