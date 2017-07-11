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
    $userData = Socialite::with('slack')->user();
    $userId = hash('sha256', $userData->id);
    $name = $userData->name;
    $splitName = explode(" ", $name);
    $firstName = $splitName[0];
    $lastName = end($splitName);

    $userInfo = UserInfos::firstOrNew(['userId' => $userId]);
    if ($userInfo['original'] == []){
      $userInfo = [
          'first_name' => $firstName,
          'last_name' => $lastName,
          'email' => $userData->email,
          'userId' => $userId,
          ];
      UserInfos::create($userInfo);
    }else{
      UserInfos::where('userId', $userId)
        ->update([
          'first_name' => $firstName,
          'last_name' => $lastName,
          'email' => $userData->email,
          ]);
    };

    $info = UserInfos::where('userId', $userId)->first(['id']);
    $userInfo = $info['attributes'];
    $userInfoId = $userInfo['id'];

    $user = User::firstOrNew(['user_info_id' => $userInfoId]);
    if ($user['original'] == []){
      $user = [
        'name' => $name,
        'password' => $userId,
        'user_info_id' => $userInfoId,
      ];
      User::create($user);
      $user = User::where('user_info_id', $userInfoId)->first();
    }else{
      User::where('user_info_id', $userInfoId)->update(['name' => $name]);
    };

    Auth::login($user);
    return redirect('/');
  }
}
