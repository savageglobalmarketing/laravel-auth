<?php

namespace SavageGlobalMarketing\Auth\Services\User;

use SavageGlobalMarketing\Foundation\Services\QueryService;
use SavageGlobalMarketing\Auth\Contracts\UserContract;

class QueryUserService extends QueryService
{
    public function __construct(UserContract $repo)
    {
        parent::__construct($repo);
    }
}
