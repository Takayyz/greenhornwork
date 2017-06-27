<?php

namespace App\Http\Controllers;

use App\Entities\Questions;
use App\Repositories\QuestionsRepository;
use App\Repositories\TagCategoryRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionsRequest;

class QuestionController extends Controller
{
  protected $question;
  protected $category;

  public function __construct(QuestionsRepository $question, TagCategoryRepository $category)
  {

    $this->middleware('auth');
    $this->question = $question;
    $this->category = $category;

  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    $categories = $this->category->all();
    $inputs = $request->all();
    $search = $request->input('search');

    if(empty($search)) {
      $questions = $this->question->getAllQuestions($inputs);
    } else {
      $questions = $this->question->getSearchedQuestions($inputs);
    }

    return view('question.index', compact('questions', 'inputs',  'categories'));

  }

  public function create()
  {

    $categories = $this->category->all();

    return view('question.create', compact('categories'));

  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {

     $userId = Auth::id();

     $input = $request->all();
     $this->question->createQuestion($input, $userId);

     return redirect()->route('question.index');

   }

   public function show($id)
   {

     $question = $this->question->find($id);

     return view('question.show', compact('question'));

   }

   public function edit($id)
   {

     $id;
     $categories = $this->category->all();
     $question = $this->question->find($id);
     $categoryname = $this->category->find($question['tag_category_id'])->name;

     return view('question.edit', compact('question', 'categories', 'categoryname', 'id'));

   }

   public function update(QuestionsRequest $request, $id)
   {

     $userId = Auth::id();
     $input = $request->all();
     $this->question->updateQuestion($input, $id, $userId);

     return redirect()->route('question.index');

   }

   public function destroy($id)
   {

     $data = $this->question->find($id);
     $data->delete();

     return redirect()->route('question.index');

   }

   public function myPage()
   {

     $userId = Auth::id();
     $questions = $this->question->getMyQuestions($userId);
     return view('question.questionmypage', compact('questions'));

   }

   public function Confirm(QuestionsRequest $request)
   {

     $question = $this->question->all();
     $res = parse_url($_SERVER['HTTP_REFERER']);
     $inputs = $request->all();
     $category = $this->category->find($inputs['tag_category_id'])->name;

     return view('question.confirm', compact('inputs', 'category', 'res', 'question'));

   }

}
