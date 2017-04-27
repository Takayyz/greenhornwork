<?php

namespace App\Http\Controllers\Admin;

//

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Repositories\UserInfosRepository;
use App\Entities\User;
use App\Mail\AccountRegister;
use App\Repositories\StoresRepository;
use Mail;

class UserController extends Controller
{
    protected $users;
    protected $stores;
    protected $userinfos;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(
      UserRepository $users,
      StoresRepository $stores,
      UserInfosRepository $userinfos)
    {
      $this->middleware('auth:admin');
      $this->users = $users;
      $this->stores = $stores;
      $this->userinfos = $userinfos;
    }

    public function index(Request $request)
    {
        $inputs = $request->all();

        // 管理者からのインプットを正常化
        $inputs = $this->users->normalizeInputs($inputs);


        // デフォルト：　ユーザー情報全権取得
        //　管理者が指定した条件によりユーザー情報を取得
        $users = $this->users->getUsersFromSearchingResult($inputs);

        $stores = $this->stores->all();
        return view('admin.user.index', compact('users', 'stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $stores = $this->stores->orderBy('kana_name', 'asc')->all();
        return view('admin.user.create', compact('stores'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //usersを第一引数に入れる事によって、バリデーションを実行する事が出来るようになる。
        $input = $request->all();
        $this->userinfos->saveUserInfo($input);

        Mail::to($input['email'])->send(new AccountRegister($input));

        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user =  $this->users->find($id);
        return view('admin.user.show', compact('user'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =  $this->users->find($id);
        $stores = $this->stores->orderBy('kana_name', 'asc')->all();
        return view('admin.user.edit', compact('user', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {

        $user =  $this->users->find($id);
        $input =  $request->all();
        $this->user->updateUserinfo($input, $user);

        User::where('id', $id)->update([
                'name'=>$input['name']
         ]);

        return redirect()->route('admin.user.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =  $this->users->find($id);
        $userinfo = $this->userinfos->find($user['user_info_id']);

        $userinfo->delete();
        $user->delete();

        return redirect()->route('admin.user.index');
    }

     public function getUserList($id)
    {
      return UserInfos::where('store_id', $id)->get();
    }
}
