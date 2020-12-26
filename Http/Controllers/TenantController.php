<?php

namespace SavageGlobalMarketing\Auth\Http\Controllers;

use SavageGlobalMarketing\Auth\Models\Tenant;
use SavageGlobalMarketing\Foundation\Http\Controllers\FoundationController as Controller;

class TenantController extends Controller
{
    public function __construct(Tenant $model)
    {
        parent::__construct($model);
    }
}
