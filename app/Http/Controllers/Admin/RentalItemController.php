<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Entities\Items;
use App\Repositories\RentInfosRepository;
use App\Repositories\ItemCategoryRepository;
use App\Repositories\UserRepository;
use App\Repositories\ItemsRepository;

class RentalItemController extends Controller
{
  protected $item;
  protected $user;
  protected $rentInfo;
  protected $category;

  public function __construct(
      RentInfosRepository $rentInfo,
      ItemsRepository $item,
      UserRepository $user,
      ItemCategoryRepository $category
    ) {
    $this->middleware('auth:admin');
    $this->item = $item;
    $this->user = $user;
    $this->rentInfo = $rentInfo;
    $this->category = $category;
  }

  public function index(Request $request)
  {
    $items = $this->item->all();

    return view('admin.rent.index', compact('items'));
  }

  public function create()
  {
    $categories = $this->category->orderBy('category', 'desc')->all();
// dd($categories);
// exit;
    return view('admin.rent.create', compact('categories'));
  }

  public function store(Request $request)
  {
    $inputs = $request->all();
  }
}
