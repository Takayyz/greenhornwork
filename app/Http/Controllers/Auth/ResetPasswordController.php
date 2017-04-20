<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // public function reset(array $credentials, Closure $callback)
    // {
    //   dd(1);
    //     // If the responses from the validate method is not a user instance, we will
    //     // assume that it is a redirect and simply return it from this method and
    //     // the user is properly redirected having an error message on the post.
    //     $user = $this->validateReset($credentials);
    //
    //     if (! $user instanceof CanResetPasswordContract) {
    //         return $user;
    //     }
    //
    //     $password = $credentials['password'];
    //
    //     // Once the reset has been validated, we'll call the given callback with the
    //     // new password. This gives the user an opportunity to store the password
    //     // in their persistent storage. Then we'll delete the token and return.
    //     $callback($user, $password);
    //
    //     $this->tokens->delete($user);
    //
    //     return static::PASSWORD_RESET;
    // }

    public function reset(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );
        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($response)
                    : $this->sendResetFailedResponse($request, $response);
    }

    protected function resetPassword($userInfos, $password)
    {
        $userInfos->user->forceFill([
            'password' => bcrypt($password),
            'remember_token' => Str::random(60),
        ])->save();

        $this->guard()->login($userInfos->user);
    }


}
