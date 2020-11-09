<?php

namespace SavageGlobalMarketing\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use SavageGlobalMarketing\Auth\Models\User;

class AuthController extends Controller
{
    use ThrottlesLogins;

    /**
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return mixed
     *
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->sendLockoutResponse($request);
        }

        $user = User::query()->where($this->username(), $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $this->clearLoginAttempts($request);

            $tokenName = $request->header('user-agent') ?? 'no_user_agent';

            $token = $user->createToken($tokenName)->accessToken;

            if ($request->cookie_login === false) {
                return response()->json(['token' => $token], 200);
            } else {
                return response()->json('success', 200)->withCookie(
                    Cookie::make(config('max-auth.token_name'), $token)
                );
            }
        } else {
            $this->incrementLoginAttempts($request);
        }

        return response()->json(['message' => 'Username or password invalid'], 400);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Validate the user login request.
     *
     * @param Request $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function revokeToken(Request $request)
    {
        if ($request->token_id) {
            $request->user()->tokens()->where('id', $request->token_id)->delete();

            return response()->noContent();
        } else {
            $request->user()->token()->delete();

            return response()->json('logout success')->withCookie(
                Cookie::forget(config('max-auth.token_name'))
            );
        }
    }
}
