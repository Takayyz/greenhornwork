<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\Entities\User;
use App\Validators\UserValidator;


/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 管理者の指定した条件で検索し、ユーザーデータを取得
     */
    public function getUsersFromSearchingResult($inputs)
    {
      $users = $this->model;
      if(!is_array($inputs)) {
        return $users->get();
      }

      //　ユーザー名で条件を絞る
      return $users->whereName('name', $inputs['user_name'])

      //　姓名で条件を絞る
      ->whereHas('info', function($query) use ($inputs) {
          $name_fields = ['first_name', 'last_name'];
          foreach($name_fields as $name_field) {
            $query->whereName($name_field, $inputs[$name_field]);
          }
      })

      //　性別、Email、電話番号で条件を絞る
      ->whereHas('info', function($query) use ($inputs) {
        $equal_fields = ['sex', 'email', 'tel'];
        foreach ($equal_fields as $equal_field) {
          $query->equal($equal_field, $inputs[$equal_field]);
        }
      })

      // 誕生日と開始日の範囲指定で条件を絞る
      ->whereHas('info', function($query) use ($inputs) {
        return $query->dateRange('birthday', $inputs['birthday-start-date'], $inputs['birthday-end-date'])
                      ->dateRange('hire_date', $inputs['hire_date-start-date'], $inputs['hire_date-end-date']);
      })

      //　店舗名で条件を絞る
      ->whereHas('info', function($query) use ($inputs) {
        return  $query->whereHas('store', function($query) use ($inputs) {
          if($inputs['store_name']) {
            return $query->where('name', $inputs['store_name']);
          } else {
            return $query;
          }
        });
      })

      // 情報を整理する
      ->orderBy('created_at', 'desc')->get();
    }

    /**
     *　管理者が入力したデータを正常化
     */
    public function normalizeInputs($inputs) {
      if(is_array($inputs)) {
        $inputs = [
          "user_name" => isset($inputs['user_name']) ? $inputs['user_name'] : "",
          "sex" => isset($inputs['sex']) ? $inputs['sex'] : "",
          "last_name" => isset($inputs['last_name']) ? $inputs['last_name'] : "",
          "first_name" => isset($inputs['first_name']) ? $inputs['first_name'] : "",
          "birthday-start-date" => isset($inputs['birthday-start-date']) ? $inputs['birthday-start-date'] : "",
          "birthday-end-date" => isset($inputs['birthday-end-date']) ? $inputs['birthday-end-date'] : "",
          "email" => isset($inputs['email']) ? $inputs['email'] : "",
          "tel" => isset($inputs['tel']) ? $inputs['tel'] : "",
          "hire_date-start-date" => isset($inputs['hire_date-start-date']) ? $inputs['hire_date-start-date'] : "",
          "hire_date-end-date" => isset($inputs['hire_date-end-date']) ? $inputs['hire_date-end-date'] : "",
          "store_name" => isset($inputs['store_name']) ? $inputs['store_name'] : ""
        ];
      } else {
        $inputs = [
          "user_name" => "",
          "sex" => "",
          "last_name" => "",
          "first_name" => "",
          "birthday-start-date" => "",
          "birthday-end-date" => "",
          "email" => "",
          "tel" => "",
          "hire_date-start-date" => "",
          "hire_date-end-date" => "",
          "store_name" => ""
        ];
      }
      return $inputs;
    }
}
