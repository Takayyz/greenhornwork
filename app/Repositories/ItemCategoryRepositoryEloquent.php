<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ItemCategoryRepository;
use App\Entities\ItemCategory;
use App\Validators\ItemCategoryValidator;

/**
 * Class ItemCategoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ItemCategoryRepositoryEloquent extends BaseRepository implements ItemCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ItemCategory::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
