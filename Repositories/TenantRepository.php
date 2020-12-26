<?php

namespace SavageGlobalMarketing\Auth\Repositories;

use SavageGlobalMarketing\Foundation\Repositories\FoundationRepository as BaseRepository;
use SavageGlobalMarketing\Auth\Contracts\TenantContract;
use SavageGlobalMarketing\Auth\Models\Tenant;

class TenantRepository extends BaseRepository implements TenantContract
{
    public function __construct(Tenant $model)
    {
        parent::__construct($model);
    }
}
