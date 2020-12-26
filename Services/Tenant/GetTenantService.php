<?php

namespace SavageGlobalMarketing\Auth\Services\Tenant;

use SavageGlobalMarketing\Foundation\Services\GetService;
use SavageGlobalMarketing\Auth\Contracts\TenantContract;

class GetTenantService extends GetService
{
    public function __construct(TenantContract $repo)
    {
        parent::__construct($repo);
    }
}
