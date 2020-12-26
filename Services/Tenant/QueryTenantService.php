<?php

namespace SavageGlobalMarketing\Auth\Services\Tenant;

use SavageGlobalMarketing\Foundation\Services\QueryService;
use SavageGlobalMarketing\Auth\Contracts\TenantContract;

class QueryTenantService extends QueryService
{
    public function __construct(TenantContract $repo)
    {
        parent::__construct($repo);
    }
}
