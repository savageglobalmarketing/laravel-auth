<?php

namespace Maxcelos\Auth\Services\User;

use Maxcelos\Foundation\Services\QueryService;
use Maxcelos\Auth\Contracts\UserContract;

class QueryUserService extends QueryService
{
    public function __construct(UserContract $repo)
    {
        parent::__construct($repo);
    }
}
