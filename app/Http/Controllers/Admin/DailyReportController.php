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
  public function index()
  {
      $reports = $this->report->getAllReports();
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

  public function search(Request $request)
  {
    $inputs = $request->all();

    //　あるユーザーのレポート情報を日付の範囲を指定し、contentsを取得。
    $reports = $this->report->getSearchingResultReport($inputs);

    return view('admin.daily_report.index', compact('reports'));
  }
}
