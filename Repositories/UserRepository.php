<?php

namespace SavageGlobalMarketing\Auth\Repositories;

use SavageGlobalMarketing\Foundation\Repositories\FoundationRepository as BaseRepository;
use SavageGlobalMarketing\Auth\Contracts\UserContract;
use SavageGlobalMarketing\Auth\Models\User;

class UserRepository extends BaseRepository implements UserContract
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
