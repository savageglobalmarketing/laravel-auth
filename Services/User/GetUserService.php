<?php

namespace SavageGlobalMarketing\Auth\Services\User;

use SavageGlobalMarketing\Foundation\Services\GetService;
use SavageGlobalMarketing\Auth\Contracts\UserContract;

class GetUserService extends GetService
{
    public function __construct(UserContract $repo)
    {
        parent::__construct($repo);
    }
}
