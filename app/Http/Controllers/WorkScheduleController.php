<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\WorkSchedulesRepository;
use App\Entities\WorkSchedules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\WorkScheduleRequest;
use Intervention\Image\ImageManagerStatic as Image;
use Validator;

class WorkScheduleController extends Controller
{
  protected $schedule;

  public function __construct(WorkSchedulesRepository $schedule)
  {
    $this->middleware('auth');
    $this->schedule = $schedule;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $userId = Auth::id();

    if(!isset($request)) {
      //一覧表示
      $schedules = $this->schedule->getOwnSchedules($userId);
    } else {
      //検索結果表示
      $input = $request->all();
      $schedules = $this->schedule->getSchedulesBySearch($input, $userId);
    }

    //ルートディレクトリ取得
    $path = env('APP_URL');
    
    return view('work_schedule.index', compact('schedules', 'path'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('work_schedule.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(WorkScheduleRequest $request)
  {
    $userId = Auth::id();
    $input = $request->all();

    //同年月の勤務表が存在しないか確認
    $errMsg = $this->schedule->checkDate($input['year'], $input['month'], $userId);
    //同年月の勤務表が存在する場合は元の画面にリダイレクト
    if(!empty($errMsg))
    {
      $request->session()->flash('flash_message', $errMsg);
      return redirect()->route('schedule.create');
    }
    //ファイル保存
    $fileInfo = $this->schedule->saveUploadFile($input['schedule'], $userId);
    //データベースへ保存
    $this->schedule->createSchedule($userId, $fileInfo['filePath'],
                                    $fileInfo['fileName'], $fileInfo['fileType'],
                                    $input['year'], $input['month']);

    return redirect()->route('schedule.index');
  }

  public function edit($id)
  {
    $schedule = $this->schedule->find($id);
    return view('work_schedule.edit')->with(compact('schedule'));
  }

  public function update(WorkScheduleRequest $request, $id)
  {
    $userId = Auth::id();
    $input = $request->all();

    //同年月の勤務表が存在しないか確認
    $errMsg = $this->schedule->checkDate($input['year'], $input['month'], $userId, $id);
    //同年月の勤務表が存在する場合は元の画面にリダイレクト
    if(!empty($errMsg))
    {
      $request->session()->flash('flash_message', $errMsg);
      return redirect()->route('schedule.edit', $id);
    }

      //ファイルがアップロードされたか確認
      if (array_key_exists('schedule', $input))
      {
        //ファイル保存
        $fileInfo = $this->schedule->saveUploadFile($input['schedule'], $userId);
        //データベース更新
        $this->schedule->updateSchedule($fileInfo['fileName'], $fileInfo['fileType'], $input['year'], $input['month'], $id);
      } else {
        $this->schedule->updateOnlyDate($input['year'], $input['month'], $id);
      }
      return redirect()->route('schedule.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      $data = $this->schedule->find($id);
      $data->delete();

      return redirect()->route('schedule.index');
  }

}
