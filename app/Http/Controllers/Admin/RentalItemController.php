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
    $categories = $this->category->all();
    $items = $this->item->getItemsBySearching($inputs);

    return view('admin.rent.index', compact('items', 'categories'));

  }

  public function create(Request $request)
  {

    $inputs = $request->all();
    $data = $this->item->normalizeInputs($inputs);

    $categories = $this->category->all();

    return view('admin.rent.create', compact('categories', 'data'));

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

  public function edit(Request $request, $id)
  {

    $inputs = $request->all();
    // $item = $this->item->checkEmptyInputs($item, $inputs);
    // 入力確認画面で戻る押下されると$inputsに入力したデータが入る。
    // それを$itemに格納し直す。
    // 詳細画面から編集押下されると$inputsは空なので、$itemには$this->item->find(id);
        if (empty($inputs))
        {
            $item = $this->item->find($id);
        } else
        {
            $inputs = $this->item->normalizeInputs($inputs);
            $item = $inputs;
        }
    $categories = $this->category->all();

    return view('admin.rent.edit' ,compact('id', 'item', 'categories'));

  }

  public function updateItems(Request $request)
  {

    $inputs = $request->all();

    $id = $inputs['id'];
    $item = $this->item->find($id);

    $res = $this->item->updateItemById($inputs, $item);

    return redirect()->route('admin.rent.index');

  }

  public function destroy($id)
  {

    $item = $this->item->find($id);
    $item->delete();

    return redirect()->route('admin.rent.index');

  }

  public function confirm(ItemsRequest $request)
  {

    $inputs = $request->all();
    $id = $inputs['item_category_id'];
    $category = $this->category->find($id);

    return view('admin.rent.confirm', compact('inputs', 'category'));

  }

  public function updateConfirm(ItemsRequest $request)
  {

    $inputs = $request->all();

    $id = $inputs['item_category_id'];
    $category = $this->category->find($id);

    return view('admin.rent.update_confirm', compact('inputs', 'category'));

  }
}
