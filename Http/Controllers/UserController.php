<?php

namespace SavageGlobalMarketing\Auth\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Nwidart\Modules\Routing\Controller;
use SavageGlobalMarketing\Auth\Models\Tenant;
use SavageGlobalMarketing\Auth\Models\User;
use SavageGlobalMarketing\Auth\Transformers\UserResource;
//use SavageGlobalMarketing\Foundation\Http\Controllers\FoundationController as Controller;

class UserController extends Controller
{
    /*protected Model $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }*/

    public function loggedUser()
    {
        /*return (new RoleResource(auth()->user()))
            ->response()
            ->setStatusCode(200);*/

        return (new UserResource(auth()->user()))
            ->response()
            ->setStatusCode(200);
    }
}
