<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AnswersRepository;
use App\Entities\Answers;
use App\Validators\AnswersValidator;

/**
 * Class AnswersRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AnswersRepositoryEloquent extends BaseRepository implements AnswersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Answers::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    // question_idに紐づいたレコードを取得
    public function getAnswer($question_id)
    {
        return $this->model->withTrashed()->where('question_id', $question_id)->get();
    }

    public function createAnswer($userId, $questionId, $content)
    {
        $this->model->create([
            'user_id' => $userId,
            'question_id' => $questionId,
            'content' => $content,
        ]);
    }
}
