<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Support\Facades\Auth;
use App\Entities\UserInfos;
use App\Entities\User;



class AuthenticateController extends Controller
{

  public function slackAuth()
  {
    return Socialite::with('slack')->scopes(['identity.basic,identity.email'])->redirect();
  }

  public function userinfo()
  {
    // ユーザー情報取得
    $userData = Socialite::with('slack')->user();
    // ユーザー作成
    $name = $userData->name;
    $splitName = explode(" ", $name);
    $firstName = $splitName[0];
    $lastName = end($splitName);
    $userInfo = UserInfos::firstOrCreate([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $userData->email,
            ]);
    $info = $userInfo['attributes'];
    $userInfoId = $info['id'];
    $email = $userData->email;
    $password = hash('sha256', $email);
    $user = User::firstOrCreate([
      'name' => $name,
      'password' => $password,
      'user_info_id' => $userInfoId,
    ]);
    Auth::login($user, true);
    return redirect('/');
  }
}
