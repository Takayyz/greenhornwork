<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\QuestionsRepository;
use App\Entities\Questions;
use App\Validators\QuestionsValidator;

/**
 * Class QuestionsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class QuestionsRepositoryEloquent extends BaseRepository implements QuestionsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Questions::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
