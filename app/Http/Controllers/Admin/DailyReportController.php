<?php

namespace App\Http\Controllers\Admin;

use App\Entities\DailyReports;
use App\Repositories\DailyReportsRepository;
use App\Repositories\UserInfosRepository;
use Illuminate\Http\Request;
use App\Http\Requests\DailyReportRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DailyReportController extends Controller
{

  protected $report;
  protected $user_info;

  public function __construct(
    DailyReportsRepository $report,
    UserInfosRepository $user_info
    )
  {
    $this->middleware('auth:admin');
    $this->report = $report;
    $this->user_info = $user_info;

  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $this->validate($request, [
        
          'start-date' => 'before:now',
          'end-date' => 'before:now',
      ],[
          'start-date.before' => '今日以前の日付を入力してください',
          'end-date.before' => '今日以前の日付を入力してください',
      ]);
      //　ユーザーの入力した値を連想配列で取得
      //　inputs: (first_name, last_name, start-date, end-date)
      $inputs = $request->all();
      //　ユーザーの入力した値を正常化
      $inputs = $this->report->normalizeInputs($inputs);
      //　あるユーザーの日報を日付の範囲で指定し、取得。
      $reports = $this->report->getReportsBySearching($inputs);
      return view('admin.daily_report.index', compact('reports'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $report = $this->report->find($id);
      return view('admin.daily_report.show', compact('report'));
  }
}
