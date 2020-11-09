<?php

namespace Maxcelos\Auth\Services\User;

use Maxcelos\Foundation\Services\DestroyService;
use Maxcelos\Auth\Contracts\UserContract;

class DestroyUserService extends DestroyService
{
    public function __construct(UserContract $repo)
    {
        parent::__construct($repo);
    }
}
