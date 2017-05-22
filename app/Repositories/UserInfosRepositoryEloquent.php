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
            'store_id' => $input['store_id'],
            'access_right' => 0,
            'position_code' => 0
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
            'store_id'=>$input['store_id'],
            'access_right' => 0,
            'position_code' => 100
         ]);
    }

    public function getUserRecord($email)
    {
      $user = $this->model->where('email', $email)->first();
      return $user;
    }

    public function getAdminUserEmail($email)
    {
      $user = $this->model->where('email', $email)->first();
      return $user;
    }

    public function getAdminUserId($id)
    {
      $user = $this->model->where('id', $id)->first();
      return $user;
    }

    public function getUserList($id)
    {
      $user = $this->model->where('store_id', $id)->get();
      return $user;
    }

    public function getAdminUsersByPositionCode($admin_user_info_id) {
      $adminuser = $this->model->when($admin_user_info_id, function($query) use ($admin_user_info_id) {
        return $query->where('id', $admin_user_info_id);
      })->first();
      return $this->model->filterByPositionCode($adminuser['position_code'])->get();
    }

    public function getEmailByUserInfoId($user_info_id) {
      return $this->model->when($user_info_id, function($query) use ($user_info_id) {
        return $query->where('id', $user_info_id);
      })->get();
    }

    public function getUserInfoByAdminUserId($admin_user_id) {
      return $this->model->whereHas('admin', function($query) use ($admin_user_id) {
        return $query->when($admin_user_id, function($query) use ($admin_user_id){
          return $query->where('id', $admin_user_id);
        });
      })->get();
    }

    public function permitAccessRights($admin_user_info_id, $access_rights) {
      // 全てのアクセス権限のフラグを組み合わせ、一つの文字列にする 例）011
      $access_right_strbin =  $access_rights['admin_right']
                            . $access_rights['user_right']
                            . $access_rights['store_right'];

      // 文字列から数字へ変換
      $access_right = bindec($access_right_strbin);

      // アクセスを許可
      return $this->model
                  ->where('id', $admin_user_info_id)
                  ->update(['access_right' => $access_right]);
    }

    public function getUserInfoByUserId($user_id) {
      return $this->model->whereHas('admin', function($query) use ($user_id) {
        return $query->when($user_id, function($query) use ($user_id) {
          return $query->where('id', $user_id);
        });
      })->first();
    }
}
