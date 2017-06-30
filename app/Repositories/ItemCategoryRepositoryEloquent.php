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

    public function createItemCategory($data)
    {

        $this->model->create([
            'category' => $data['category']
        ]);
    }

    public function updateItemCategory($data, $category)
    {
        $this->model->where('id', $category['id'])->update([
            'category' => $data['category']
        ]);
    }

    public function normalizeInputs($data)
    {

        if(is_array($data))
        {

            $data = [
                'category' => isset($data['category']) ? $data['category'] : '',
            ];
        } else {
            $data = [
                'category' => '',
            ];
        }

        return $data;

    }
}
