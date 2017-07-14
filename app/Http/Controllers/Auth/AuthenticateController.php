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
    return Socialite::with('slack')->scopes(['users:read'])->redirect();
  }

  public function userinfo()
  {
    $userData = Socialite::with('slack')->scopes(['users:read'])->user();
    dd($userData);
    $slackUserId = hash('sha256', $userData->id);
    $name = $userData->name;
    $splitName = explode(" ", $name);
    $firstName = $splitName[0];
    $lastName = end($splitName);

    $userInfo = UserInfos::firstOrNew(['slack_user_id' => $slackUserId]);
    if ($userInfo['original'] == []){
      $this->createUserInfo($userInfo, $firstName, $lastName, $userData, $slackUserId);
    }else{
      $this->updateUserInfo($slackUserId, $firstName, $lastName, $userData);
    };

    $info = UserInfos::where('slack_user_id', $slackUserId)->first(['id']);
    $userInfo = $info['attributes'];
    $userInfoId = $userInfo['id'];

    $user = User::firstOrNew(['user_info_id' => $userInfoId]);
    if ($user['original'] == []){
      $user = $this->createUser($user, $name, $slackUserId, $userInfoId);
    }else{
      $this->updateUser($userInfoId, $name);
    };

    Auth::login($user);
    return redirect('/');
  }

  public function createUserInfo($userInfo, $firstName, $lastName, $userData, $slackUserId)
  {
    $userInfo = [
      'first_name' => $firstName,
      'last_name' => $lastName,
      'email' => $userData->email,
      'slack_user_id' => $slackUserId,
      ];
    UserInfos::create($userInfo);
  }

  public function updateUserInfo($slackUserId, $firstName, $lastName, $userData)
  {
    UserInfos::where('slack_user_id', $slackUserId)
      ->update([
          'first_name' => $firstName,
          'last_name' => $lastName,
          'email' => $userData->email,
        ]);
  }

  public function createUser($user, $name, $slackUserId, $userInfoId)
  {
    $user = [
      'name' => $name,
      'password' => $slackUserId,
      'user_info_id' => $userInfoId,
    ];
    User::create($user);
    return User::where('user_info_id', $userInfoId)->first();
  }

  public function updateUser($userInfoId, $name)
  {
    User::where('user_info_id', $userInfoId)->update(['name' => $name]);
  }

}