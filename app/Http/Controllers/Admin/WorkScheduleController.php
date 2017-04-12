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
  public function index()
  {
    $schedules = $this->schedule->getAllSchedules();
    return view('admin.work_schedule.index', compact('schedules'));
  }

  public function search(Request $request)
  {
    $input = $request->all();

    $schedules = $this->schedule->getSchedulesBySearch($input);

    return view('admin.work_schedule.index', compact('schedules'));
  }

}
