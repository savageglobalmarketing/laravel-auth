<?php

namespace Maxcelos\Auth\Services\User;

use Maxcelos\Foundation\Services\GetService;
use Maxcelos\Auth\Contracts\UserContract;

class GetUserService extends GetService
{
    public function __construct(UserContract $repo)
    {
        parent::__construct($repo);
    }
}
