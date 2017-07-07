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
  )
  {

    $this->middleware('auth:admin');
    $this->item = $item;
    $this->category = $category;

  }

  public function index(Request $request)
  {

    $inputs = $request->all();
    $categories = $this->category->all();

    if (!empty($inputs))
    {
      $items = $this->item->getItemsBySearching($inputs);

    return view('admin.rent.index', compact('items', 'categories'));
    } else {

      $items = $this->item->all();

      return view('admin.rent.index', compact('items', 'categories'));
    }

  }

  public function create(Request $request)
  {
    $inputs = $request->session()->get('_old_input');

    if (!empty($inputs))
    {
      $data = $inputs;
    } else if (!empty($request->all()))
    {
      $data = $request->session()->get('data');
    } else {
      $data = null;
    }

    $categories = $this->category->all();

    return view('admin.rent.create', compact('categories', 'data'));

  }

  public function store(Request $request)
  {

    $inputs = $request->session()->pull('data');

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
    $request->flash();

    $request->old();
    $item = $this->item->find($id);
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

    $request->session()->put('data', $inputs);
    $data = $request->session()->get('data');

    $category = $this->category->find($data['item_category_id'])->category;

    return view('admin.rent.confirm', compact('data', 'category'));

  }

  public function updateConfirm(ItemsRequest $request)
  {

    $inputs = $request->all();

    $id = $inputs['item_category_id'];
    $category = $this->category->find($id);

    return view('admin.rent.update_confirm', compact('inputs', 'category'));

  }
}
