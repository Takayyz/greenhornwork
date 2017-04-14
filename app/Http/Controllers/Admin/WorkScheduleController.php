<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WorkSchedulesRepository;
use App\Entities\WorkSchedules;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WorkScheduleRequest;

class WorkScheduleController extends Controller
{
  protected $schedule;

  public function __construct(WorkSchedulesRepository $schedule)
  {
    $this->middleware('auth:admin');
    $this->schedule = $schedule;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $input = $request->all();
    if(empty($input)) {
      //一覧表示
      $schedules = $this->schedule->getAllSchedules();
    } else {
      //検索結果表示
      $schedules = $this->schedule->getSchedulesSearch($input);
    }

    return view('admin.work_schedule.index', compact('schedules'));

  }
}
