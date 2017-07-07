<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\Entities\SlackUsers;
use Auth;


class AuthenticateController extends Controller
{

  public function slackAuth()
  {
    return Socialite::with('slack')->scopes(['users:read'])->redirect();
  }

  public function userinfo()
  {
    // ユーザー情報取得
    $userData = Socialite::with('slack')->user();
    // ユーザー作成
    $user = SlackUsers::firstOrCreate([
            'username' => $userData->name,
            'email' => $userData->email,
            'access_token' => $userData->token,
            ]);
//    $aaa = $user['attributes'];
//    $bbb = array('username' => $aaa['username'], 'email' => $aaa['email'], 'access_token' => $aaa['access_token']);

    dd($user);
    Auth::login($user, true);
    return redirect('/');
  }
}
