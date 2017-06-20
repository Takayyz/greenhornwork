<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Entities\ItemCategory;
use App\Repositories\ItemCategoryRepository;
use App\Http\Requests\ItemCategoryRequest;

class ItemCategoryController extends Controller
{
    protected $category;
    // public $err;

    public function __construct(ItemCategoryRepository $category)
    {

      $this->middleware('auth:admin');
      $this->category = $category;

    }

    public function index($err = NULL)
    {
      // dd(empty($err));
      // if(empty($err)) $err = '';
      $categories = $this->category->all();

      return view('admin.item_category.index', compact('categories'));

    }

    public function create()
    {

      return view('admin.item_category.create');

    }

    public function store(ItemCategoryRequest $request)
    {

      $inputs = $request->all();
      $res = $this->category->createItemCategory($inputs);

      return redirect()->route('admin.item_category.index');

    }

    public function edit($id)
    {

      $category = $this->category->find($id);

      return view('admin.item_category.edit', compact('category'));

    }

    public function update(ItemCategoryRequest $request, $id)
    {

      $inputs = $request->all();
      $category = $this->category->find($id);

      $res = $this->category->updateItemCategory($inputs, $category);

      return redirect()->route('admin.item_category.index');

    }

    public function destroy($id)
    {

      if (!isset($this->category->find($id)->item)) {

        $category = $this->category->find($id);
        $category->delete();

        return redirect()->route('admin.item_category.index');

      } else {
        $err = '使用されているカテゴリーです。';

        return back()->with('err');
      }
    }
}
