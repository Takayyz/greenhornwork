<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ItemsRepository;
use App\Entities\Items;
use App\Validators\ItemsValidator;

/**
 * Class ItemsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ItemsRepositoryEloquent extends BaseRepository implements ItemsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Items::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function saveRentalItem($inputs)
    {
        $this->model->create([
            'name' => $inputs['name'],

        ]);
    }
}
