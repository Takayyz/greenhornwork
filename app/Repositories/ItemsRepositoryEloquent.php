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

    // public function saveRentalItem($inputs)
    // {
    //     $this->model->create([
    //         'name' => $inputs['name'],

    //     ]);
    // }

    public function createItems($data)
    {
        $this->model->create([
            "name" => $data['name'],
            "item_category_id" => $data['item_category_id'],
            "item_info" => $data['item_info'],
            ]);
    }

    public function updateItemById($data, $item)
    {
        $this->model->where('id', $item['id'])->update([
            "name" => $data['name'],
            "item_category_id" => $data['item_category_id'],
            "item_info" => $data['item_info']
        ]);
    }

    public function normalizeInputs($data)//UserRepositoryEloquent写し
    {
        if(is_array($data))
        {
            $data = [
                // 'id' => isset($data['id']) ? $data['id'] : '',
                'name' => isset($data['name']) ? $data['name'] : '',
                'item_category_id' => isset($data['item_category_id']) ? $data['item_category_id'] : '',
                'item_info' => isset($data['item_info']) ? $data['item_info'] : ''
            ];
        } else {
            $data = [
                'name' => '',
                'item_category_id' => '',
                'item_info' => ''
            ];
        }

        return $data;
    }

    public function getItemsBySearching($data)
    {
        //DailyReportsRepositoryEloquent,UserRepositoryEloquent参照
        //名称絞り
        return $this->model->whereName('name', $data['name'])
        //種類絞り
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
