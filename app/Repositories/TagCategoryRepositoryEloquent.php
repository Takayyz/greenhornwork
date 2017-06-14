<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TagCategoryRepository;
use App\Entities\TagCategory;
use App\Validators\TagCategoryValidator;

/**
 * Class TagCategoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TagCategoryRepositoryEloquent extends BaseRepository implements TagCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TagCategory::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
