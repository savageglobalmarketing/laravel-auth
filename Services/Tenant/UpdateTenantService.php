<?php

namespace SavageGlobalMarketing\Auth\Services\Tenant;

use SavageGlobalMarketing\Foundation\Services\UpdateService;
use SavageGlobalMarketing\Auth\Contracts\TenantContract;

class UpdateTenantService extends UpdateService
{
    public function __construct(TenantContract $repo)
    {
        parent::__construct($repo);
    }
}
