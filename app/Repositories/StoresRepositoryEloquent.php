<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StoresRepository;
use App\Entities\Stores;
use App\Validators\StoresValidator;

/**
 * Class StoresRepositoryEloquent
 * @package namespace App\Repositories;
 */
class StoresRepositoryEloquent extends BaseRepository implements StoresRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Stores::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getSearchedStoreName($input)
    {
        $result = $this->model->where('name', 'LIKE',"%" . $input['storeName'] . "%")->get();
        return $result;
    }
}