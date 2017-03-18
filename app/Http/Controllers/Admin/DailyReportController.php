<?php

namespace App\Http\Controllers\Admin;

use App\Entities\DailyReports;
use App\Repositories\DailyReportsRepository;
use Illuminate\Http\Request;
use App\Http\Requests\DailyReportRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DailyReportController extends Controller
{

  protected $report;

  public function __construct(DailyReportsRepository $report)
  {
    $this->middleware('auth:admin');
    $this->report = $report;

  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $reports = $this->report->getAllReports();
      return view('admin.daily_report.index',compact('reports'));
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
      return view('admin.daily_report.show')->with(compact('report'));
  }


}
