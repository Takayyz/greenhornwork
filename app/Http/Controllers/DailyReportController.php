<?php

namespace App\Http\Controllers;

use App\Entities\DailyReports;
use App\Repositories\DailyReportsRepository;
use Illuminate\Http\Request;
use App\Http\Requests\DailyReportRequest;
use Illuminate\Support\Facades\Auth;

class DailyReportController extends Controller
{

  protected $report;

  public function __construct(DailyReportsRepository $report)
  {
    $this->middleware('auth');
    $this->report = $report;

  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $userId = Auth::id();
    $reports = $this->report->getOwnReports($userId);
    return view('daily_report.index',compact('reports'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(DailyReportRequest $request)
  {

    $userId = Auth::id();

    $input = $request->all();
    $this->report->create([
      'user_id' => $userId,
      'reporting_time' => $input['date'],
      'title' => $input['title'],
      'contents' =>$input['contents'],
    ]);

    return redirect()->to('user/report');
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
    $report = $this->report->find($id);
    return view('daily_report.edit')->with(compact('report'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(DailyReportRequest $request, $id)
  {
    $userId = Auth::id();
    $input = $request->all();
    $this->report->update([
                'user_id' => $userId,
                'reporting_time' => $input['date'],
                'title' => $input['title'],
                'contents' =>$input['contents'],
              ],$id);
    return redirect()->to('user/report');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $data = $this->report->find($id);
    $data->delete();

    return redirect()->to('user/report');
  }
}
