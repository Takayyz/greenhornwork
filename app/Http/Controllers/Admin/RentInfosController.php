<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Entities\RentInfos;
use App\Repositories\RentInfosRepository;
use App\Repositories\UserRepository;
use App\Repositories\ItemsRepository;

class RentInfosController extends Controller
{
  protected $item;
  protected $user;
  protected $rentInfo;

  public function __construct(
      RentInfosRepository $rentInfo,
      ItemsRepository $item,
      UserRepository $user
    ) {
    $this->middleware('auth:admin');
    $this->item = $item;
    $this->user = $user;
    $this->rentInfo = $rentInfo;
  }

  public function index(Request $Request)
  {
    $rentInfos = $this->rentInfo->all();


    return view('admin.rent.index', compact('rentInfos'));
  }
}
