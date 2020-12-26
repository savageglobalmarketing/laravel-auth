<?php

namespace SavageGlobalMarketing\Auth\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use SavageGlobalMarketing\Auth\Http\Middleware\AuthMiddleware;
use SavageGlobalMarketing\Auth\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use SavageGlobalMarketing\Foundation\Providers\AuthServiceProvider as ServiceProvider;
use Symfony\Component\Finder\Finder;

class AuthServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Auth';

    protected string $moduleNameLower = 'auth';

    protected string $modulePath = __DIR__ . '/../';

    /**
     * Boot the application events.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot()
    {
        $this->registerConfig();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));

        if (class_exists('Laravel\Passport\Passport')) {
            \Laravel\Passport\Passport::hashClientSecrets();
        }

        Relation::morphMap([
            'users' => User::class
        ]);

        $this->app->make('router')->aliasMiddleware('auth', AuthMiddleware::class);

        parent::boot();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        parent::register();
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path('sav-auth.php'),
        ], 'config');

        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), 'sav-auth'
        );
    }
}
