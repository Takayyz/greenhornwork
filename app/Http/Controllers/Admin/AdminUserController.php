<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\AdminUsers;
use App\Repositories\AdminUsersRepository;
use App\Repositories\UserinfosRepository;
use App\Http\Requests\AdminUserRequest;
use App\Http\Requests\AdminUserEditRequest;
use Mail;
use App\Mail\AdminAccountRegister;
use App\Mail\AdminAccountMailEdit;

class AdminUserController extends Controller
{
    protected $adminuser;
    protected $userinfos;

    public function __construct(
      AdminUsersRepository $adminuser,
      UserinfosRepository $userinfo
      )
    {
      $this->middleware('auth:admin');
      $this->adminuser = $adminuser;
      $this->userinfo = $userinfo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminusers = $this->adminuser->all();

        return view('admin.admin_user.index', compact('adminusers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */public function create()
    {
        return view('admin.admin_user.create');
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request)
    {
        $input = $request->all();
        $this->userinfo->create([
          'first_name' => $input['first_name'],
          'last_name' => $input['last_name'],
          'sex' => $input['sex'],
          'birthday' => $input['birthday'],
          'email' => $input['email'],
          'tel' => $input['tel'],
          'hire_date' => $input['hire_date'],
          'store_id' => 0,
        ]);

        Mail::to($input['email'])->send(new AdminAccountRegister($input));

        return redirect()->route('admin.adminuser.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adminuser = $this->adminuser->find($id);
        return view ('admin.admin_user.show', compact('adminuser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adminuser = $this->adminuser->find($id);
        return view('admin.admin_user.edit', compact('adminuser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserEditRequest $request, $id)
    {
        $input = $request->all();
        $this->adminuser->update([
          'name' => $input['name'],
        ], $id);

        $this->userinfo->update([
          'first_name' => $input['first_name'],
          'last_name' => $input['last_name'],
          'sex' => $input['sex'],
          'tel' => $input['tel'],
        ], $id);

        return redirect()->route('admin.adminuser.index');
    }

    public function mailedit($id)
    {
      $adminuser = $this->adminuser->find($id);
      return view('admin.admin_user.mailedit', compact('adminuser'));
    }

    public function sendmail(Request $request)
    {
      $input = $request->all();
      $email = $input['email'];
      Mail::to($email)->send(new AdminAccountMailEdit($email));

      return redirect()->route('admin.adminuser.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = $this->adminuser->find($id);
        $userinfoid = $data['user_info_id'];
        $userinfo = $this->userinfo->getAdminUserId($userinfoid);
        $data->info()->delete();
        $data->delete();

        return redirect()->route('admin.adminuser.index');
    }
}
