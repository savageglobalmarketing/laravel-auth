<?php

namespace SavageGlobalMarketing\Auth\Services\Tenant;

use SavageGlobalMarketing\Foundation\Services\CreateService;
use SavageGlobalMarketing\Auth\Contracts\TenantContract;

class CreateTenantService extends CreateService
{
    public function __construct(TenantContract $repo)
    {
        parent::__construct($repo);
    }
}
