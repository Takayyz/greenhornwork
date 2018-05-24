<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Questions;
use App\Repositories\QuestionsRepository;
use App\Repositories\TagCategoryRepository;
use App\Entities\Answers;
use App\Repositories\AnswersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    protected $question;
    protected $category;
    protected $answer;

    public function __construct(
        QuestionsRepository $question,
        TagCategoryRepository $category,
        AnswersRepository $answer)
    {
        $this->middleware('auth:admin');
        $this->question = $question;
        $this->category =  $category;
        $this->answer = $answer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($this->question->all());
        $categories = $this->category->all();
        $inputs = $request->all();
        // 検索の有無で条件分岐。検索かけられてなければ全件取得
        if(empty($inputs['search']) && empty($inputs['tag_category_id'])) {
            $questions = $this->question->getIsNotAnsweredQuestion();
        } else {
            $questions = $this->question->getSearchedIsNotAnsweredQuestionTitle($inputs);
        }
        return view('admin.answer.index', compact('questions', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // $questions = $this->question->find($id);
        // return view('admin.answer.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId =  Auth::id();
        $questionId = $request->question_id;
        $this->question->addAnswerFlag($questionId);
        $content = $request->content;
        $this->answer->createAnswer(
            $userId, 
            $questionId, 
            $content);
        return redirect()->route('admin.answer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->question->find($id);
        // 回答済み(has_answerカラムが1)ならば回答取得
        // if($question->has_answer === 1)
        // {
        //     $answer = $this->answer->getAnswer($id);
        // }
        // dd($answer);
        return view('admin.answer.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->question->find($id)->delete();
        return redirect()->route('admin.answer.index');
    }

    public function confirm(Request $request)
    {
        $question = $request->all();
        // dd($question);
        return view('admin.answer.confirm', compact('question'));
    }

    public function answered()
    {
        $categories = $this->category->all();
        $questions = $this->question->getAnsweredQuestion();
        // dd($questions);
        return view('admin.answer.answered', compact('categories', 'questions'));
    }

    public function detail($id)
    {
        // idに紐づいた質問を削除済みも含め取得
        $questions = $this->question->getSelectedQuestion($id);
        if($this->answer->getAnswer($id))
        {
            $answers = $this->answer->getAnswer($id);
        }
        // dd($questions);

        return view('admin.answer.detail', compact('questions', 'answers'));

    }
}
