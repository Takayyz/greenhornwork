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

    public function getMyPageQuestions($user_id)
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

    public function addAnswerFlag($id)
    {
      $this->model->where('id', $id)->update(['has_answer' => 1]);
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

    public function getSearchedQuestionTitle($inputs)
    {

      $result = $this->model->where('title', 'LIKE',"%" . $inputs['search'] . "%")->get()->when($inputs['tag_category_id'], function($query) use ($inputs)
       {
         return $query->where('tag_category_id', $inputs['tag_category_id']);
        });
      return $result;

    }

    public function getSearchedIsNotAnsweredQuestionTitle($inputs)
    {

      $result = $this->model->withTrashed()->where('has_answer', NULL)->where('title', 'LIKE',"%" . $inputs['search'] . "%")->get()->when($inputs['tag_category_id'], function($query) use ($inputs)
       {
         return $query->where('tag_category_id', $inputs['tag_category_id']);
        });
      return $result;

    }

    public function getAnsweredQuestion()
    {
      return $this->model->withTrashed()->where('has_answer', 1)->get();
    }

    public function getIsNotAnsweredQuestion()
    {
      return $this->model->withTrashed()->where('has_answer', NULL)->get();
    }

    public function getSelectedQuestion($id)
    {
      return $this->model->withTrashed()->where('id', $id)->get();
    }
}
