<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Entities\Stores;
use App\Repositories\StoresRepository;
use App\Repositories\UserInfosRepository;
use App\Http\Requests\StoreRequest;

class StoreController extends Controller
{
  protected $stores;
  protected $user_infos;

  public function __construct(
    StoresRepository $stores,
    UserInfosRepository $user_infos
  ) {
      $this->middleware('auth:admin');
      $this->stores = $stores;
      $this->user_infos = $user_infos;
    }

  public function index(Request $request)
  {
    $input = $request->all();

    if(empty($input)) {
      //一覧表示
      $stores = $this->stores->orderBy('kana_name', 'asc')->all();
    } else {
      //検索結果表示
      $stores = $this->stores->getSearchedStoreName($input);
    }
    return view('admin.store.index', compact('stores'));
  }

  public function create()
  {
    return view('admin.store.create');
  }

  public function store(StoreRequest $request)
  {
    $input = $request->all();
    $this->stores->create([
      'name' => $input['name'],
      'kana_name' => $input['kana_name'],
    ]);

    return redirect()->to('admin/store');
  }

  public function show($id)
  {
    $store = $this->stores->find($id);
    $userList = $this->user_infos->getUserList($id);
    return view('admin.store.show', compact('store', 'userList'));
  }

  public function edit($id)
  {
    $store = $this->stores->find($id);
    return view('admin.store.edit',compact('store'));
  }

  public function update(StoreRequest $request, $id)
  {
    $input = $request->all();
    $this->stores->update([
      'name' => $input['name'],
      'kana_name' => $input['kana_name']
    ], $id);
    return redirect()->to('admin/store');
  }

  public function destroy($id)
  {
    $data = $this->stores->find($id);
    $data->delete();

    return redirect()->to('admin/store');
  }
}
