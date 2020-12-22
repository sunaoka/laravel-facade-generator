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
        $this->mergeConfigFrom(
            __DIR__ . '/../config/facade-generator-default.php',
            'facade-generator'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [__DIR__ . '/../config/facade-generator.php' => config_path('facade-generator.php')],
            'facade-generator-config'
        );

        if ($this->app->runningInConsole()) {
            $this->commands(
                FacadeMakeCommand::class,
                ProviderMakeCommand::class,
                ServiceMakeCommand::class
            );
        }
    }
}
