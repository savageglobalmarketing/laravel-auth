<?php

namespace SavageGlobalMarketing\Auth\Services\User;

use SavageGlobalMarketing\Foundation\Services\DestroyService;
use SavageGlobalMarketing\Auth\Contracts\UserContract;

class DestroyUserService extends DestroyService
{
    public function __construct(UserContract $repo)
    {
        parent::__construct($repo);
    }
}
