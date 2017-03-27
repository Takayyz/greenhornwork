<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\WorkSchedulesRepository;
use App\Entities\WorkSchedules;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WorkScheduleRequest;

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
    $schedules = $this->schedule->orderBy('year', 'desc')
                                ->orderBy('month', 'desc')
                                ->all();
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

    $uploadFile = $input['schedule'];
    //ファイルの拡張子取得
    $fileType = $uploadFile->getClientOriginalExtension();
    //ファイルパスを取得
    $filePath = 'schedules/' .$userId . '/' ;
    $fileFullPath = public_path() . '/schedules/' .$userId . '/';
    //ユーザーのフォルダが存在しなければ作成
    if(!file_exists($fileFullPath))
    {
      mkdir($fileFullPath);
    }
    //ファイル名が重複しないように変更
    $fileName = $this->schedule->changeFileName($fileType);

    if ($fileType === 'pdf')
    {
      //PDFの処理
      $uploadFile->move($fileFullPath, $fileName);
    } else
    {
      //画像の処理
      $img = Image::make($uploadFile);
      $img->save($filePath. $fileName);
    }

    //データベースへの保存処理
    $this->schedule->create([
      'user_id' => $userId,
      'file_path' => $filePath,
      'file_name' => $fileName,
      'file_type' => $fileType,
      'year' => $input['year'],
      'month' => $input['month'],
    ]);

    return redirect()->to('schedule');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
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
      $data = $this->schedule->find($id);
      $data->delete();

      return redirect()->to('schedule');
  }
}
