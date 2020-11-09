<?php

namespace SavageGlobalMarketing\Auth\Services\User;

use SavageGlobalMarketing\Foundation\Services\UpdateService;
use SavageGlobalMarketing\Auth\Contracts\UserContract;

class UpdateUserService extends UpdateService
{
    public function __construct(UserContract $repo)
    {
        parent::__construct($repo);
    }
}
