<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\UserInfosRepository;
use App\Entities\User;
use App\Mail\MailSent;

//use App\Requests\usersはusers.phpの中のバリデーションへアクセスしている。

class UserController extends Controller
{
    protected $user;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(UserInfosRepository $user)
    {

      $this->middleware('auth:admin');
      $this->user = $user;
    }

    public function index()
    {

        $users = $this->user->all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/user/create');

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
    public function store(users $request)
    {
        //usersを第一引数に入れる事によって、バリデーションを実行する事が出来るようになる。
            $input = $request->all();
            $this->user->create([

            'first_name' => $input['first_name'],
            'last_name' =>$input["last_name"],
            'sex' => $input['sex'],
            // 'birthday'=>$input["birthday"],
            'email' => $input["email"],
            'tel' => $input['tel'],
            'hire_date' => $input['hire_date'],
            // 'store_id' => $input['store_name']

        ]);

        // return redirect()->route('user.index');

        // $user = Users::create(
        //     request(['name', 'email', 'password'])
        // );


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);
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
        $user = $this->user->find($id);
        // dd($users);
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Users $request, $id)
    {
        $input =  $request->all();
        // $user = $this->user->find($id);
        $this->user->update([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email'=>$input["email"],
                'tel'=>$input['tel'],
                'hire_date'=>$input['hire_date'],
                // 'store_id'=>$input['store_name']
         ],$id);

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
        $user = $this->user->find($id);
        $user->delete();

        return redirect()->route('admin.user.index');
    }
}
