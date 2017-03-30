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
  public function index()
  {
    $userId = Auth::id();
    $schedules = $this->schedule->getOwnSchedules($userId);
    return view('work_schedule.index', compact('schedules'));
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

    if ($errMsg === NULL)
    {
      $uploadFile = $input['schedule'];
      //ファイルの拡張子取得
      $fileType = $uploadFile->getClientOriginalExtension();
      //ファイルパスを取得
      $filePath = 'schedules/' .$userId . '/' ;
      $fileFullPath = public_path() . '/' . $filePath;
      //ファイル格納先のフォルダが存在しなければ作成
      if (!file_exists($fileFullPath))  mkdir($fileFullPath);
      //ファイル名が重複しないように変更
      $fileName = $this->schedule->changeFileName($fileType);
      //ファイル保存
      $this->schedule->saveUploadFile($fileType, $uploadFile, $fileName, $filePath);

      //データベースへ保存
      $this->schedule->insertSchedule($userId, $filePath, $fileName, $fileType, $input['year'], $input['month']);

      return redirect()->to(route('schedule.index'));

    } else {
      return redirect()->to(route('schedule.create'))->with('message', $errMsg);
    }
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

    if ($errMsg === NULL)
    {
      if (array_key_exists('schedule', $input))
      {
        $uploadFile = $input['schedule'];
        //ファイルの拡張子取得
        $fileType = $uploadFile->getClientOriginalExtension();
        //ファイルパスを取得
        $filePath = 'schedules/' .$userId . '/' ;
        //ファイル名が重複しないように変更
        $fileName = $this->schedule->changeFileName($fileType);
        //ファイル保存
        $this->schedule->saveUploadFile($fileType, $uploadFile, $fileName, $filePath);
        //データベース更新
        $this->schedule->updateSchedule($fileName, $fileType, $input['year'], $input['month'], $id);
      } else {
        $this->schedule->updateOnlyDate($input['year'], $input['month'], $id);
      }
      return redirect()->to(route('schedule.index'));

    } else {
      return redirect()->to(route('schedule.edit', $id))->with('message', $errMsg);
    }
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

      return redirect()->to(route('schedule.index'));
  }
}
