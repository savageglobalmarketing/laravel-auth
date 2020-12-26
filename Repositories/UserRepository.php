<?php

namespace SavageGlobalMarketing\Auth\Repositories;

use SavageGlobalMarketing\Foundation\Repositories\FoundationRepository;
use SavageGlobalMarketing\Auth\Contracts\UserContract;
use SavageGlobalMarketing\Auth\Models\User;

class UserRepository extends FoundationRepository implements UserContract
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
