<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DailyReportsRepository;
use App\Entities\DailyReports;
use App\Validators\DailyReportsValidator;

/**
 * Class DairyReportsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class DailyReportsRepositoryEloquent extends BaseRepository implements DailyReportsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DailyReports::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAllReports()
    {
      $reports = $this->model->orderBy('reporting_time', 'desc')
                             ->get();
      return $reports;
    }

    public function getOwnReports($userId)
    {
      $reports = $this->model->where('user_id', $userId)
                             ->orderBy('reporting_time', 'desc')
                             ->get();
      return $reports;
    }

}
