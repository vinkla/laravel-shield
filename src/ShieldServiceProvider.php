<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-shield
 */

declare(strict_types=1);

namespace Vinkla\Shield;

use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;
use Laravel\Lumen\Application as LumenApplication;

class ShieldServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->setupConfig();
    }

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

    public function register(): void
    {
        $this->app->singleton('shield', function (Container $app) {
            $users = $app['config']['shield.users'];
            $driver = $app['config']['shield.password'] ?? 'hash';

            if (!in_array($driver, ['password', 'plain'])) {
                throw new InvalidArgumentException("Invalid password driver [$driver].");
            }

            $auth = match ($driver) {
                'hash' => new PasswordHash(),
                'plain' => new PlainText(),
            };

            return new Shield($users, $auth);
        });

        $this->app->alias('shield', Shield::class);
    }

    public function provides(): array
    {
        return [
            'shield',
        ];
    }
}
