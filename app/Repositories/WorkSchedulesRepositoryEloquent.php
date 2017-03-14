<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\WorkSchedulesRepository;
use App\Entities\WorkSchedules;
use App\Validators\WorkSchedulesValidator;

/**
 * Class WorkSchedulesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class WorkSchedulesRepositoryEloquent extends BaseRepository implements WorkSchedulesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return WorkSchedules::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
