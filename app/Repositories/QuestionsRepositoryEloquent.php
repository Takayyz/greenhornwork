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

    public function getAllQuestions($inputs)
    {

        $inputs['tag_category_id'] = $inputs['tag_category_id'] ?? "";
        $dataOfTheUser = $this->model->get();

        //whenメソッド - 最初のパラメータがである場合にのみ、実行される
        $dataOfTheUser = $dataOfTheUser->when($inputs['tag_category_id'], function($query) use ($inputs) {
          return $query->where('tag_category_id', $inputs['tag_category_id']);
        });
        return $dataOfTheUser;

    }

    public function getMyQuestions($user_id)
    {

      return $this->model->where('user_id', $user_id)->get();

    }

    public function createQuestion($data, $userId)
    {

      $this->model->create([
      'user_id' => $userId,
        'tag_category_id' => $data['tag_category_id'],
        'title' => $data['title'],
        'content' => $data['content'],
      ]);

    }

    public function updateQuestion($data, $id, $userId)
    {

      $rec = $this->model->find($id);
      $rec->user_id = $userId;
      $rec->title = $data['title'];
      $rec->tag_category_id = $data['tag_category_id'];
      $rec->content = $data['content'];
      $rec->save();

    }

    public function getSearchedQuestions($inputs)
    {

      $result = $this->model->where('title', 'LIKE',"%" . $inputs['search'] . "%")->get();
      $result = $result->when($inputs['tag_category_id'], function($query) use ($inputs) {
        return $query->where('tag_category_id', $inputs['tag_category_id']);
      });
      return $result;

    }

}
