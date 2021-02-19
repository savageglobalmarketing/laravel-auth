<?php

namespace SavageGlobalMarketing\Auth;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->check()) {
            $builder->where($model->getTable() . '.tenant_id', auth()->user()->current_tenant_id);
        }
    }
}
