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

    public function getReportByDateRange($start_date, $end_date, $userId = null)
    {
      // Administrator用の処理
      if(empty($userId)) {
        $searchedReport = $this->model
                                  ->dateRange($start_date, $end_date)
                                  ->get();
      } else {
        //　値が両方空ならそのユーザーに関するレポートデータ全てを取得
        if(empty($start_date) && empty($end_date)) {
          $searchedReport = $this->model->find($userId)->get();
        } else {
          $searchedReport = $this->model
                                    ->find($userId)
                                    ->dateRange($start_date, $end_date)
                                    ->get();
        }
      }
      return $searchedReport;
    }

    public function getSearchingResultReport($inputs)
    {
      $result = null;
      if(!is_array($inputs)) {
        $result = $this->model->get();
      }

      if($inputs['start-date'] && $inputs['end-date']) {
        $result = $this->model->dateRange($inputs['start-date'], $inputs['end-date'])
          ->whereHas('user', function($query) use ($inputs) {
            return $query->whereHas('info', function ($query) use ($inputs) {
              $fields = ['first_name', 'last_name'];
              foreach($fields as $field) {
                return $query->name($field, $inputs[$field]);
              }
            });
          })->get();
      } else {
        $result = $this->model
          ->whereHas('user', function($query) use ($inputs) {
            return $query->whereHas('info', function ($query) use ($inputs) {
              $fields = ['first_name', 'last_name'];
              foreach($fields as $field) {
                return $query->name($field, $inputs[$field]);
              }
            });
          })->get();
      }
      return $result;
    }
}
