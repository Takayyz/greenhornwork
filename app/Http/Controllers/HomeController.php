<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\DailyReports;
use App\Repositories\DailyReportsRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $reports;

    public function __construct(DailyReportsRepository $reports)
    {
      $this->middleware('auth');
      $this->reports = $reports; 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
