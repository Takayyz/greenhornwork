<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Entities\Items;
use App\Repositories\ItemCategoryRepository;
use App\Repositories\ItemsRepository;

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

  public function index()
  {
//$this->item->orderBy('item_category_id', 'asc or desc')->all();で種類別で表示順を昇降順選べる
    $items = $this->item->all();

    return view('admin.rent.index', compact('items'));

  }

  public function create()
  {

    $categories = $this->category->all();

    return view('admin.rent.create', compact('categories'));

  }

  public function store(Request $request)
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

  public function update(Request $request, $id)
  {

    $item = $this->item->find($id);
    $inputs = $request->all();

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
