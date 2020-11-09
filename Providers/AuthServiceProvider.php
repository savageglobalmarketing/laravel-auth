<?php

namespace Maxcelos\Auth\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Laravel\Passport\Passport;
use Maxcelos\Auth\Http\Middleware\AuthMiddleware;
use Maxcelos\Auth\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Maxcelos\Foundation\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array $bindings
     */
    public $bindings = [];

    /**
     * @var array $polices
     */
    protected $policies = [];

    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Auth';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'auth';

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

        Passport::hashClientSecrets();

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
            __DIR__ . '/../Config/passport.php' => config_path('passport.php'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/../Config/auth.php' => config_path('auth.php'),
        ], 'config');

        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path('max-auth.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), 'max-auth'
        );
    }
}
