<?php

namespace App\Http\Controllers\Admin;

//

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\UserInfosRepository;
use App\Entities\User;

use App\Mail\AccountRegister;
use App\Repositories\StoresRepository;
use Mail;


//use App\Requests\usersはusers.phpの中のバリデーションへアクセスしている。

class UserController extends Controller
{

    protected $stores;
    protected $user; 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(
     StoresRepository $stores,
     UserInfosRepository $user)
    {
      $this->middleware('auth:admin');
      $this->stores = $stores;
      $this->user = $user;
    }

    public function index()
    {

        $users = User::orderBy('created_at', 'desc')->get();
        // $users = $this->user->all();
        // dd($users->);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $stores = $this->stores->orderBy('kana_name', 'asc')->all();
        return view('admin/user/create', compact('stores'));


        // \Mail::to($user)->send(new Email);

    //     Mail::send('emails.welcome', ['key' => 'value'], function($message)
    // {
    //     $message->to('foo@example.com', 'John Smith')->subject('Welcome!');


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
            $this->user->UserInfoSave($input);
        // $user = Users::create(
        //     request(['name', 'email', 'password'])
        // );

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
        $user = User::find($id);
        // $user = $this->user->find($id);
        return view('admin.user.show', compact('user'));
        // $user = Users::find($id);
        // return view ('user.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
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
        $user = User::find($id);
        $input =  $request->all();
        // $user = $this->user->find($id);
        $this->user->update([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'sex' => $input['sex'],
                'birthday' => $input['birthday'],
                'email'=>$input["email"],
                'tel'=>$input['tel'],
                'hire_date'=>$input['hire_date'],
                'store_id'=>$input['store_id']
         ],$user['user_info_id']);

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
        $user = User::find($id);
        $userinfo = $this->user->find($user['user_info_id']);

        $userinfo->delete();
        $user->delete();

        return redirect()->route('admin.user.index');
    }

}
