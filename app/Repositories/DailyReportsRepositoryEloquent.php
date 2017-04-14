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

    /**
     *　あるユーザーの複数ある日報を日付の範囲で指定し
     *　該当の日報を全て出力。
     *
     *  @param Array
     */
    public function getReportsByDateRange($inputs)
    {
      //　ユーザーを検索
      $dataOfTheUser = $this->model->whereUserId($inputs['id']);

      //　そのユーザーの日報の中から日付の範囲で検索
      $dataOfTheUser = $dataOfTheUser->dateRange("reporting_time", $inputs['start-date'], $inputs['end-date']);

      //　表示の順番を報告日付順に指定する。
      return $dataOfTheUser->orderBy('reporting_time')->get();
    }

    /**
     *　ユーザーから送られた情報を正常化。
     *  @param Array
     */
    public function normalizeInputs($inputs)
    {
      if(is_array($inputs)) {
        $inputs = [
          'id' => isset($inputs['id']) ? $inputs['id'] : '',
          'start-date' => isset($inputs['start-date']) ? $inputs['start-date'] : '',
          'end-date' => isset($inputs['end-date']) ? $inputs['end-date'] : '',
          'first_name' => isset($inputs['first_name']) ? $inputs['first_name'] : '',
          'last_name' => isset($inputs['last_name']) ? $inputs['last_name'] : ''
        ];
      } else {
        $inputs = [
          'id' => '',
          'start-date' => '',
          'end-date' => '',
          'first_name' => '',
          'last_name' => ''
        ];
      }
      return $inputs;
    }

    /**
     *　あるユーザーの日報を日付の範囲で指定し、取得。
     */
    public function getReportsBySearching($inputs)
    {
      return $this->model->dateRange("reporting_time", $inputs['start-date'], $inputs['end-date'])
        ->whereHas('user', function($query) use ($inputs) {
          return $query->whereHas('info', function ($query) use ($inputs) {
            $fields = ['first_name', 'last_name'];
            foreach($fields as $field) {
              $query->whereName($field, $inputs[$field]);
            }
          });
        })
        //　日報を作成した順に表示
        ->orderBy('reporting_time')->get();
    }
}
