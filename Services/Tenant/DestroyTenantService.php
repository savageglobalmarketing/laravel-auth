<?php

namespace SavageGlobalMarketing\Auth\Services\Tenant;

use SavageGlobalMarketing\Foundation\Services\DestroyService;
use SavageGlobalMarketing\Auth\Contracts\TenantContract;

class DestroyTenantService extends DestroyService
{
    public function __construct(TenantContract $repo)
    {
        parent::__construct($repo);
    }
}
