<?php

namespace Maxcelos\Auth\Services\User;

use Maxcelos\Foundation\Services\UpdateService;
use Maxcelos\Auth\Contracts\UserContract;

class UpdateUserService extends UpdateService
{
    public function __construct(UserContract $repo)
    {
        parent::__construct($repo);
    }
}
