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

    public function saveUserInfo($input)
    {
        $this->model->create([
            'first_name' => $input['first_name'],
            'last_name' =>$input['last_name'],
            'sex' => $input['sex'],
            'birthday'=>$input['birthday'],
            'email' => $input['email'],
            'tel' => $input['tel'],
            'hire_date' => $input['hire_date'],
            'store_id' => $input['store_id']
        ]);
    }

    public function updateUserInfo($input, $user)
    {
        $this->model->where('id',$user['user_info_id'])->update([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'sex' => $input['sex'],
            'birthday' => $input['birthday'],
            'email'=>$input["email"],
            'tel'=>$input['tel'],
            'hire_date'=>$input['hire_date'],
            'store_id'=>$input['store_id']
         ]);
    }

    public function getUserRecord($email)
    {
      $user = $this->model->where('email', $email)->first();
      return $user;
    }

    public function getAdminUserEmail($email)
    {
      return UserInfos::where('email', $email)->first();
    }

    public function getAdminUserId($id)
    {
      return UserInfos::where('id', $id)->first();
    }

    /**
     * 管理者の指定した条件で検索し、ユーザーデータを取得
     */
    public function getUsersFromSearchingResult($inputs)
    {
      // Table: stores, user_infos, users
      // user_name, sex, last_name, first_name, birthday-start-date, birthday-end-date, email, tel, hire_date-start-date, hire_date-end-date, store_name
      $userinfos = $this->model;

      if(!is_array($inputs)) {
        return $this->model->get();
      }

      //　ユーザー名で条件を絞る
      $userinfos->whereHas('user', function($query) use ($inputs) {
        return $query->whereName('name', $inputs['user_name']);
      });

      //　姓名で条件を絞る
      $name_fields = ['first_name', 'last_name'];
      foreach($name_fields as $name_field) {
        $userinfos->whereName($name_field, $inputs[$name_field]);
      }

      //　性別、Email、電話番号で条件を絞る
      $equal_fields = ['sex', 'email', 'tel'];
      foreach($equal_fields as $equal_field) {
        $userinfos->equal($equal_field, $inputs[$equal_field]);
      }

      // 誕生日と開始日の範囲指定で条件を絞る
      $userinfos->whereDate('birthday', $inputs['birthday-start-date'], $inputs['birthday-end-date'])
                ->whereDate('hire_date', $inputs['hire_date-start-date'], $inputs['hire_date-end-date']);

      //　店舗名で条件を絞る
      $userinfos->whereHas('store', function($query) use ($inputs) {
        return $query->where('name', $inputs['store_name']);
      });

      return $userinfos->get();
    }
}
