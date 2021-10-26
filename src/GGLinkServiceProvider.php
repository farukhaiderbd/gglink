<?php

namespace Codershout\GGLink;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Codershout\GGLink\Middleware\UserMiddlewares;
class GGLinkServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        // $this->loadmiddlewaresFrom(__DIR__ . '/middlewares/')
        $this->loadViewsFrom(__DIR__ . '/views', 'gglink');
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('auth.user', UserMiddlewares::class);
        // $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->mergeConfigFrom(
            __DIR__ . '/config/gglink.php',
            'gglink'
        );

        $this->publishes([
            // __DIR__ . '/config/gglink.php' => config_path('gglink.php'),
            __DIR__ . '/views' => resource_path('views/vendor/gglink')
        ]);
    }

    public function register()
    {
    }
}
