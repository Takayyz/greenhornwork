<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\WorkSchedulesRepository;
use App\Entities\WorkSchedules;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WorkScheduleRequest;
use Intervention\Image\ImageManagerStatic as Image;

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
    //ファイルを保存する
    $input = $request->all();

    $img = Image::make($request->file('schedule'));

    //ファイル名を重複しないように変更する処理を書く
    $img->save('schedules/test.jpg');

    //ファイルパスを取得する
    $filePath = "public/schedules/test.jpg";
    //ファイルの種類を取得する


    //データベースへの保存処理
    $this->schedule->create([
      'user_id' => $userId,
      'file_path' => $filePath,
      'file_type' => 'jpg',
      'year_month' => $input['time'],
    ]);

    return redirect()->to('user/schedule');
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

      return redirect()->to('user/schedule');
  }
}
