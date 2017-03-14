<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DairyReportsRepository;
use App\Entities\DairyReports;
use App\Validators\DairyReportsValidator;

/**
 * Class DairyReportsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class DairyReportsRepositoryEloquent extends BaseRepository implements DairyReportsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DairyReports::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
