<?php

namespace SavageGlobalMarketing\Auth\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use SavageGlobalMarketing\Auth\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return true; //$user->can('user_read');
    }

    public function create(User $user)
    {
        return true; //$user->can('user_create');
    }

    public function view(User $user, User $register)
    {
        return true; //$user->can('user_read');
    }

    public function update(User $user, User $register)
    {
        return true; //$user->can('user_update');
    }

    public function delete(User $user, User $register)
    {
        return true; //$user->can('user_destroy');
    }
}
