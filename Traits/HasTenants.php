<?php

namespace SavageGlobalMarketing\Auth\Traits;

use SavageGlobalMarketing\Auth\Models\Tenant;

trait HasTenants
{
    public function hasTenancies()
    {
        return $this->tenancies()->count() > 0;
    }

    public function tenancies()
    {
        return $this->belongsToMany(Tenant::class, 'auth_tenant_users', 'user_id', 'tenant_id')/*->withPivot(['role'])*/->orderBy('name', 'asc');
    }

    public function onTenant(Tenant $tenant)
    {
        return $this->tenancies->contains($tenant);
    }

    public function ownsTenant(Tenant $tenant)
    {
        return $this->id == $tenant->owner_id;
    }

    public function ownedTenancies()
    {
        return $this->hasMany(Tenant::class, 'owner_id');
    }

    public function getCurrentTenantAttribute()
    {
        return $this->currentTenant();
    }

    public function currentTenant()
    {
        if (is_null($this->current_tenant_id) && $this->hasTenancies()) {
            $this->switchToTenant($this->tenancies->first());

            return $this->currentTenant();
        } elseif (! is_null($this->current_tenant_id)) {
            $currentTenant = $this->tenancies->find($this->current_tenant_id);

            return $currentTenant ?: $this->refreshCurrentTenant();
        }
    }

    public function ownsCurrentTenant()
    {
        return $this->currentTenant() && $this->currentTenant()->owner_id == $this->id;
    }

    public function switchToTenant(Tenant $tenant)
    {
        if (! $this->onTenant($tenant)) {
            throw new InvalidArgumentException(__("tenancies.user_doesnt_belong_to_tenant"));
        }

        $this->current_tenant_id = $tenant->id;

        $this->save();
    }

    public function refreshCurrentTenant()
    {
        $this->current_tenant_id = null;

        $this->save();

        return $this->currentTenant();
    }
}
