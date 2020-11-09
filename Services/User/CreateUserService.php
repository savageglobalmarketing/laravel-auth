<?php

namespace Maxcelos\Auth\Services\User;

use Maxcelos\Foundation\Services\CreateService;
use Maxcelos\Auth\Contracts\UserContract;

class CreateUserService extends CreateService
{
    public function __construct(UserContract $repo)
    {
        parent::__construct($repo);
    }
}
