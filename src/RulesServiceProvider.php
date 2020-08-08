<?php

namespace Lvlo\Rules;

use Seat\Services\AbstractSeatPlugin;
use Illuminate\Routing\Router;
use Seat\Web\Http\Middleware\Authenticate;
use Seat\Web\Http\Middleware\Locale;
use Seat\Web\Http\Middleware\RegistrationAllowed;
use Seat\Web\Http\Middleware\Requirements;

class RulesServiceProvider extends AbstractSeatPlugin
{
    /**
     * Bootstrap the application services.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        $this->add_routes();
        $this->add_views();
        $this->add_migrations();
        $this->add_translations();
        $this->add_middleware($router);
    }

    /**
     * Include the middleware needed.
     *
     * @param \Illuminate\Routing\Router $router
     */
    private function add_middleware(Router $router)
    {

        // Authenticate checks that the session is
        // simply authenticated
        $router->aliasMiddleware('auth', Authenticate::class);

        // Ensure that all of the SeAT required modules is installed.
        $router->aliasMiddleware('requirements', Requirements::class);

        // Localization support
        $router->aliasMiddleware('locale', Locale::class);

        // Registration Middleware checks of the app is
        // allowing new user registration to occur.
        $router->aliasMiddleware('registration.status', RegistrationAllowed::class);
    }

    /**
     * Include the translations and set the namespace.
     */
    private function add_translations()
    {

        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'rules');
    }

    /**
     * Set the path for migrations which should
     * be migrated by laravel. More informations:
     * https://laravel.com/docs/5.5/packages#migrations.
     */
    private function add_migrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations/');
    }

    /**
     * Set the path and namespace for the vies.
     */
    private function add_views()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'rules');
    }

    public function register()
    {
        // Menu Configurations
        $this->mergeConfigFrom(
            __DIR__ . '/Config/package.sidebar.php', 'package.sidebar');
    }

    public function add_routes()
    {
        if (!$this->app->routesAreCached()) {
            include __DIR__ . '/Http/routes.php';
        }
    }

    public function getName(): string
    {
        return "LVLO RulesController";
    }

    public function getPackageRepositoryUrl(): string
    {
        return "";
    }

    public function getPackagistPackageName(): string
    {
        return "seat-rules";
    }

    public function getPackagistVendorName(): string
    {
        return "lvlo";
    }

    public function getVersion(): string
    {
        return "1.0";
    }
}