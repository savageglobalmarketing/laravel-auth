<?php

namespace SavageGlobalMarketing\Auth\Services\Register;

use Illuminate\Support\Facades\DB;
use SavageGlobalMarketing\Acl\Services\Role\CreateRoleService;
use SavageGlobalMarketing\Auth\Services\Auth\LoginService;
use SavageGlobalMarketing\Auth\Services\Tenant\CreateTenantService;
use SavageGlobalMarketing\Auth\Services\User\CreateUserService;
use Spatie\Permission\Models\Permission;

class RegisterService
{
    public function run(array $data, $loginUser = true)
    {
        DB::beginTransaction();

        // Create User
        $user = app(CreateUserService::class)->run([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'password_confirmation' => $data['password_confirmation'],
        ])->toModel();

        // Create Tenant
        $tenant = app(CreateTenantService::class)->run([
            'name' => $data['tenant_name'],
            'owner_id' => $user->id
        ])->toModel();

        // Attach user to tenant
        $user->tenancies()->attach($tenant);

        $user->switchToTenant($tenant);

        // Create admin role
        $role = app(CreateRoleService::class)->run([
            'name' => 'admin',
            'display_name' => 'Admin',
            'tenant_id' => $tenant->id,
        ]);

        // Attach all permissions to admin role
        $role->toModel()->permissions()->sync(Permission::all()->pluck(['id'])->toArray());

        // Attach admin role to user
        $user->roles()->attach($role->toModel()->id);

        DB::commit();

        if ($loginUser) {
            // Send verification email
            $user->sendEmailVerificationNotification();

            // Log in user
            return app(LoginService::class)->run($user, $data['user_agent'], $data['cookie_login']);
        }

        return $user;
    }
}
