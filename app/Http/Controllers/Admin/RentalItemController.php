<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Entities\Items;
use App\Repositories\ItemCategoryRepository;
use App\Repositories\ItemsRepository;
use App\Http\Requests\ItemsRequest;

class RentalItemController extends Controller
{
  protected $item;
  protected $user;
  protected $rentInfo;
  protected $category;

  public function __construct(
      ItemsRepository $item,
      ItemCategoryRepository $category
    ) {

    $this->middleware('auth:admin');
    $this->item = $item;
    $this->category = $category;

  }

  public function index(Request $request)
  {
    $inputs = $request->all();//検索内容全取得
    $inputs = $this->item->normalizeInputs($inputs);
//$this->item->orderBy('item_category_id', 'asc or desc')->all();で種類別で表示順を昇降順選べる
    // dd($inputs);
    $categories = $this->category->all();
    $items = $this->item->getItemsBySearching($inputs);
    return view('admin.rent.index', compact('items', 'categories'));

  }

  public function create()
  {

    $categories = $this->category->all();

    return view('admin.rent.create', compact('categories'));

  }

  public function store(ItemsRequest $request)
  {

    $inputs = $request->all();
    $res = $this->item->createItems($inputs);

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
    $categories = $this->category->all();

    return view('admin.rent.edit' ,compact('item', 'categories'));

  }

  public function update(ItemsRequest $request, $id)
  {

    $inputs = $request->all();
    $item = $this->item->find($id);

    $res = $this->item->updateItem($inputs, $item);

    return redirect()->route('admin.rent.index');

  }

  public function destroy($id)
  {

    $item = $this->item->find($id);
    $item->delete();

    return redirect()->route('admin.rent.index');

  }
}
