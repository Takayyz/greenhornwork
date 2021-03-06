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

    public function createItems($data)
    {
        $this->model->create([
            "name" => $data['name'],
            "item_category_id" => $data['item_category_id'],
            "item_info" => $data['item_info'],
            ]);
    }

    public function updateItemById($data)
    {
        $this->model->where('id', $data['id'])->update([
            "name" => $data['name'],
            "item_category_id" => $data['item_category_id'],
            "item_info" => $data['item_info']
        ]);
    }

    public function getItemsBySearching($data)
    {

        return $this->model->whereName('name', $data['name'])
        ->whereHas('category', function($query) use ($data)
        {
            if($data['item_category_id'])
            {
                return$query->where('id', $data['item_category_id']);
            } else {
                return $query;
            }
        })->get();
    }
}
