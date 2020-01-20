<?php

/*
 * This file is part of Laravel Shield.
 *
 * (c) Vincent Klaiber <hello@doubledip.se>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Shield;

use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * This is the shield service provider class.
 *
 * @author Vincent Klaiber <hello@doubledip.se>
 */
class ShieldServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig(): void
    {
        $source = realpath($raw = __DIR__ . '/../config/shield.php') ?: $raw;

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('shield.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('shield');
        }

        $this->mergeConfigFrom($source, 'shield');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('shield', function (Container $app) {
            $config = $app['config']['shield.users'];

            return new Shield($config);
        });

        $this->app->alias('shield', Shield::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [
            'shield',
        ];
    }
}
