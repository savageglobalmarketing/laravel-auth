<?php

namespace Maxcelos\Auth\Http\Controllers;

use Maxcelos\Auth\Transformers\RoleResource;
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
