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
}
