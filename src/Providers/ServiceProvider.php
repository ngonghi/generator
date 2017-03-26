<?php

namespace LaravelRocket\Generator\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use LaravelRocket\Generator\Console\Commands\HelperGeneratorCommand;
use LaravelRocket\Generator\Console\Commands\ModelGeneratorCommand;
use LaravelRocket\Generator\Console\Commands\RepositoryGeneratorCommand;
use LaravelRocket\Generator\Console\Commands\ServiceGeneratorCommand;
use LaravelRocket\Generator\Generators\AlterMigrationGenerator;
use LaravelRocket\Generator\Generators\CreateMigrationGenerator;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(
            'command.rocket.make.repository',
            function ($app) {
                return new RepositoryGeneratorCommand($app['config'], $app['files'], $app['view']);
            }
        );

        $this->app->singleton(
            'command.rocket.make.service',
            function ($app) {
                return new ServiceGeneratorCommand($app['config'], $app['files'], $app['view']);
            }
        );

        $this->app->singleton(
            'command.rocket.model.make',
            function ($app) {
                return new ModelGeneratorCommand($app['config'], $app['files'], $app['view']);
            }
        );

        $this->app->singleton(
            'command.rocket.make.helper',
            function ($app) {
                return new HelperGeneratorCommand($app['config'], $app['files'], $app['view']);
            }
        );

        $this->app->singleton(
            'command.rocket.make.migration.create',
            function ($app) {
                return new CreateMigrationGenerator($app['config'], $app['files'], $app['view']);
            }
        );

        $this->app->singleton(
            'command.rocket.make.migration.alter',
            function ($app) {
                return new AlterMigrationGenerator($app['config'], $app['files'], $app['view']);
            }
        );

        $this->commands(
            'command.rocket.make.repository',
            'command.rocket.make.service',
            'command.rocket.model.make',
            'command.rocket.make.helper',
            'command.rocket.make.migration.create',
            'command.rocket.make.migration.alter'
        );
    }

}
