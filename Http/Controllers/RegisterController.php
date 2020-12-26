<?php

namespace SavageGlobalMarketing\Auth\Http\Controllers;

use Nwidart\Modules\Routing\Controller;
use SavageGlobalMarketing\Auth\Http\Requests\RegisterRequest;
use SavageGlobalMarketing\Auth\Services\Register\RegisterService;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->all();

        $data['user_agent'] = $request->header('user-agent') ?? 'no_user_agent';
        $data['cookie_login'] = $request->cookie_login ?? true;

        return app(RegisterService::class)->run($data);
    }
}
