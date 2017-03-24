<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Entities\Stores;
use App\Repositories\StoresRepository;
use App\Repositories\UserinfosRepository;
use App\Http\Requests\StoreFormRequest;

class StoreController extends Controller
{
    protected $stores;
    protected $user_infos;

    public function __construct(
      StoresRepository $stores,
      UserinfosRepository $user_infos
    ) {
      $this->middleware('auth:admin');
      $this->stores = $stores;
      $this->user_infos = $user_infos;
    }

    public function index() {
      $stores = $this->stores->orderBy('kananame', 'asc')->all();
      return view('admin.store.index', compact('stores'));
    }

    public function create() {
      return view('admin.store.create');
    }

    public function store(Request $request, StoreFormRequest $storeformrequest) {
      $input = $request->all();
      $this->stores->create([
        'name' => $input['name'],
      ]);

      return redirect()->to('admin/store');
    }

    public function show($id) {
      $store = $this->stores->find($id);
      $userList = $this->user_infos->getUserList($id);
      return view('admin.store.show', compact('store', 'userList'));
    }

    public function destroy($id) {
      $data = $this->stores->find($id);
      $data->delete();

      return redirect()->to('admin/store');
    }

}
