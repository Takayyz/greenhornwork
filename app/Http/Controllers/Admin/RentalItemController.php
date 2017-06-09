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

  public function index()
  {

    $items = $this->item->all();

    return view('admin.rent.index', compact('items'));
  
  }

  public function create()
  {
  
    $categories = $this->category->orderBy('category', 'desc')->all();

    return view('admin.rent.create', compact('categories'));
  
  }

  public function store(Request $request)
  {
  
    $inputs = $request->all();  
    $res = $this->item->createItems($inputs);
    dd($input);
    exit;

    return redirect()->route('admin.rent.index');
  }

  public function show($id)
  {
    $item = $this->item->find($id);

    return view('admin.rent.show', compact('item'));
  }

  public function edit($id)
  {
    $item = $this->item->find($id);
    $categories = $this->category->orderBy('category', 'desc')->all();

    return view('admin.rent.edit' ,compact('item', 'categories'));
  }

  public function update(Request $request, $id)
  {
    $self_user_id = Auth::id();//自身の情報取得

    $item = $this->item->find($id);
    $inputs = $repuest->all();
    $res = $this->item->updateItem($inputs, $item);

    return redirect()->route('admin.rent.index');
  }
}
