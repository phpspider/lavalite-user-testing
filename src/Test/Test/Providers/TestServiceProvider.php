<?php

namespace Test\Test\Providers;

use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Load view
        $this->loadViewsFrom(__DIR__ . '/../../../../resources/views', 'test');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/../../../../resources/lang', 'test');

        // Call pblish redources function
        $this->publishResources();

        include __DIR__ . '/../Http/routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Bind facade
        $this->app->bind('test', function ($app) {
            return $this->app->make('Test\Test\Test');
        });

        // Bind Test to repository
        $this->app->bind(
            \Test\Test\Interfaces\TestRepositoryInterface::class,
            \Test\Test\Repositories\Eloquent\TestRepository::class
        );

        $this->app->register(\Test\Test\Providers\AuthServiceProvider::class);
        $this->app->register(\Test\Test\Providers\EventServiceProvider::class);
        $this->app->register(\Test\Test\Providers\RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['test'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__ . '/../../../../config/config.php' => config_path('package/test.php')], 'config');

        // Publish view files
        $this->publishes([__DIR__ . '/../../../../resources/views' => base_path('resources/views/vendor/test')], 'view');

        // Publish language files
        $this->publishes([__DIR__ . '/../../../../resources/lang' => base_path('resources/lang/vendor/test')], 'lang');

        // Publish migrations
        $this->publishes([__DIR__ . '/../../../../database/migrations/' => base_path('database/migrations')], 'migrations');

        // Publish seeds
        $this->publishes([__DIR__ . '/../../../../database/seeds/' => base_path('database/seeds')], 'seeds');

        // Publish public folder.
        $this->publishes([__DIR__ . '/../../../../public' => public_path('/')], 'public');
    }
}
