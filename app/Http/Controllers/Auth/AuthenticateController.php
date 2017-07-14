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
    return Socialite::with('slack')->scopes(['identity.basic', 'identity.email', 'identity.team'])->redirect();
  }

  public function userinfo()
  {
    if (array_key_exists('error', $_GET)) {
      return redirect('/');
    };

    $userData = Socialite::with('slack')->user();
    $splitName = explode(" ", $userData->name);
    $firstName = $splitName[0];
    $lastName = end($splitName);

    $userInfo = UserInfos::firstOrNew(['slack_user_id' => $userData->id]);
    if ($userInfo['original'] == []) {
      $this->createUserInfo($userInfo, $firstName, $lastName, $userData);
    }else{
      $this->updateUserInfo($firstName, $lastName, $userData);
    };

    $info = UserInfos::where('slack_user_id', $userData->id)->first();
    $userInfoId = $info['attributes']['id'];
    $user = User::firstOrNew(['user_info_id' => $userInfoId]);
    if ($user['original'] == []) {
      $user = $this->createUser($user, $userData, $userInfoId);
    }else{
      $this->updateUser($userInfoId, $userData);
    };

    Auth::login($user);
    return redirect('/');
  }

  public function createUserInfo($userInfo, $firstName, $lastName, $userData)
  {
    $userInfo = [
      'first_name' => $firstName,
      'last_name' => $lastName,
      'email' => $userData->email,
      'slack_user_id' => $userData->id,
      ];
    UserInfos::create($userInfo);
  }

  public function updateUserInfo($firstName, $lastName, $userData)
  {
    UserInfos::where('slack_user_id', $userData->id)
      ->update([
          'first_name' => $firstName,
          'last_name' => $lastName,
          'email' => $userData->email,
        ]);
  }

  public function createUser($user, $userData, $userInfoId)
  {
    $user = [
      'name' => $userData->name,
      'password' => $userData->id,
      'user_info_id' => $userInfoId,
    ];
    User::create($user);
    return User::where('user_info_id', $userInfoId)->first();
  }

  public function updateUser($userInfoId, $userData)
  {
    User::where('user_info_id', $userInfoId)->update(['name' => $userData->name]);
  }

}