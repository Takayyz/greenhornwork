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

    public function __construct(ItemCategoryRepository $category)
    {

      $this->middleware('auth:admin');
      $this->category = $category;

    }

    public function index()
    {

      $categories = $this->category->all();

      return view('admin.item_category.index', compact('categories'));

    }

    public function create()
    {

      return view('admin.item_category.create');

    }

    public function store(Request $request)
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

    public function updateCategory(Request $request)
    {

      $inputs = $request->all();

      $id = $inputs['id'];
      $category = $this->category->find($id);

      $res = $this->category->updateItemCategory($inputs, $category);

      return redirect()->route('admin.item_category.index');

    }

    public function destroy($id)
    {

        $category = $this->category->find($id);
        $category->delete();

        return redirect()->route('admin.item_category.index');

    }

    public function confirm(ItemCategoryRequest $request)
    {
      $request->flash();
      $inputs = $request->old();

      return view('admin.item_category.confirm', compact('inputs'));

    }

    public function updateConfirm(ItemCategoryRequest $request)
    {

      $request->flash();
      $inputs = $request->old();

      return view('admin.item_category.update_confirm', compact('inputs'));

    }
}
