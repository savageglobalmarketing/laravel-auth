<?php

namespace SavageGlobalMarketing\Auth\Services\Auth;

use Illuminate\Support\Facades\Cookie;
use SavageGlobalMarketing\Auth\Transformers\UserResource;

class LoginService
{
    public function run($user, $agent = 'no_user_agent', $cookieLogin = true, $returnUser = true)
    {
        $token = $user->createToken($agent)->accessToken;

        $data = [
            'message' => 'success',
        ];

        if ($returnUser) {
            $data['user'] = new UserResource($user);
        }

        if ($cookieLogin === false) {
            $data['token'] = $token;

            return response()->json($data, 200);
        } else {
            return response()->json($data, 200)->withCookie(
                Cookie::make(config('sav-auth.token_name'), $token)
            );
        }
    }
}
