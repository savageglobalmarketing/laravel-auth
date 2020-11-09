<?php

namespace SavageGlobalMarketing\Auth\Services\User;

use SavageGlobalMarketing\Foundation\Services\CreateService;
use SavageGlobalMarketing\Auth\Contracts\UserContract;

class CreateUserService extends CreateService
{
    public function __construct(UserContract $repo)
    {
        parent::__construct($repo);
    }
}
