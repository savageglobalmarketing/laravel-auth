<?php

namespace SavageGlobalMarketing\Auth\Http\Controllers;

use SavageGlobalMarketing\Auth\Transformers\RoleResource;
use Nwidart\Modules\Routing\Controller;

class UserController extends Controller
{
    public function loggedUser()
    {
        return (new RoleResource(auth()->user()))
            ->response()
            ->setStatusCode(200);
    }
}
