<?php

namespace SavageGlobalMarketing\Auth\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use SavageGlobalMarketing\Auth\Models\Tenant;
use App\Models\User;

class TenantPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->can('tenant_read');
    }

    public function create(User $user)
    {
        return $user->can('tenant_create');
    }

    public function view(User $user, Tenant $tenant)
    {
        return $user->can('tenant_read');
    }

    public function update(User $user, Tenant $tenant)
    {
        return $user->can('tenant_update');
    }

    public function delete(User $user, Tenant $tenant)
    {
        return $user->can('tenant_destroy');
    }
}
