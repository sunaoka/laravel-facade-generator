<?php

namespace Sunaoka\LaravelFacadeGenerator;

use Illuminate\Support\ServiceProvider;
use Sunaoka\LaravelFacadeGenerator\Commands\FacadeMakeCommand;
use Sunaoka\LaravelFacadeGenerator\Commands\ProviderMakeCommand;
use Sunaoka\LaravelFacadeGenerator\Commands\ServiceMakeCommand;

class FacadeGeneratorServiceProvider extends ServiceProvider
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
