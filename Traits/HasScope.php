<?php

namespace SavageGlobalMarketing\Auth\Traits;

use SavageGlobalMarketing\Auth\TenantScope as Scope;

trait HasScope
{
    /*
     * Defines the tenancy scope
     */
    protected static function boot()
    {
        parent::boot();

        if (isset(self::$scope[0])) {
            $scope = new self::$scope[0];
        } else {
            $scope = new Scope;
        }

        static::addGlobalScope($scope);
    }
}
