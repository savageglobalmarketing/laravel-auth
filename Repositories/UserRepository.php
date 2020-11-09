<?php

namespace Maxcelos\Auth\Repositories;

use Maxcelos\Foundation\Repositories\FoundationRepository as BaseRepository;
use Maxcelos\Auth\Contracts\UserContract;
use Maxcelos\Auth\Models\User;

class UserRepository extends BaseRepository implements UserContract
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
