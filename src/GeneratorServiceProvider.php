<?php

namespace Sunaoka\Generator;

use Illuminate\Support\ServiceProvider;
use Sunaoka\Generator\Commands\FacadeMakeCommand;
use Sunaoka\Generator\Commands\ProviderMakeCommand;
use Sunaoka\Generator\Commands\ServiceMakeCommand;

class GeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FacadeMakeCommand::class, function ($app) {
            return new FacadeMakeCommand($app['files']);
        });

        $this->app->singleton(ProviderMakeCommand::class, function ($app) {
            return new ProviderMakeCommand($app['files']);
        });

        $this->app->singleton(ServiceMakeCommand::class, function ($app) {
            return new ServiceMakeCommand($app['files']);
        });

        $this->commands(
            FacadeMakeCommand::class,
            ProviderMakeCommand::class,
            ServiceMakeCommand::class
        );
    }
}
