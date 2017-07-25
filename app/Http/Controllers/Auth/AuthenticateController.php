<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserInfosRepository;
use App\Repositories\UserRepository;


class AuthenticateController extends Controller
{

  protected $userInfos;
  protected $users;

  public function __construct(UserInfosRepository $userInfos, UserRepository $users)
  {
    $this->userInfos = $userInfos;
    $this->users = $users;
  }

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

    $userInfo = $this->userInfos->getSlackUserInfos($userData);
    if (empty($userInfo)) {
      $savedUserInfo = $this->userInfos->createUserInfos($userInfo, $firstName, $lastName, $userData);
    }else{
      $savedUserInfo = $this->userInfos->updateUserInfos($firstName, $lastName, $userData);
    };

    $userInfoId = $savedUserInfo['attributes']['id'];
    $user = $this->users->getSlackUsers($userInfoId);
    if (empty($user)) {
      $savedUser = $this->users->createUser($userData, $userInfoId);
    }else{
      $savedUser = $this->users->updateUser($userInfoId, $userData);
    };

    Auth::login($savedUser);
    return redirect('/');
  }

}