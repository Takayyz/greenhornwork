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
      $schedules = $this->schedule->all();
      return view('work_schedule.index');
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
  public function store(Request $request)
  {
      //
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
      //
  }

  public function upload(WorkScheduleRequest $request)
  {
    $userId = Auth::id();
    //ファイルを保存する

    //HTTPリクエストからアップロードされたフォルダを取得
    $fileTmp = $request->file('schedule');
    //ファイル名を取得
    $fileName = $fileTmp->getClientOriginalName();
    //ファイルの格納先取得
    $fileDir = public_path() . '/schedules/';
    //ファイルを保存する
    $save = $fileTmp->move($fileDir, $fileName);

    //保存したパスをデータベースに保存する

    //データベースに保存するファイルパスを作成
    $filePath = $fileDir . $fileName;
    //データベースへの保存処理
    $this->schedule->create([
      'user_id' => $userId,
      'file_path' => $filePath,
      'file_type' => 'jpg',
    ]);

    return redirect()->to('user/schedule');
  }
}
