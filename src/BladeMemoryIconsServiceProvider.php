<?php

declare(strict_types=1);

namespace Codeat3\BladeMemoryIcons;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

final class BladeMemoryIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-memory-icons', []);

            $factory->add('memory-icons', array_merge(['path' => __DIR__ . '/../resources/svg'], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/blade-memory-icons.php', 'blade-memory-icons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/svg' => public_path('vendor/blade-memory-icons'),
            ], 'blade-memory'); // TODO: updating this alias to `blade-memory-icons` in next major release

            $this->publishes([
                __DIR__ . '/../config/blade-memory-icons.php' => $this->app->configPath('blade-memory-icons.php'),
            ], 'blade-memory-icons-config');
        }
    }
}
