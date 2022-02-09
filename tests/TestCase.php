<?php

namespace Sunaoka\LaravelFacadeGenerator\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Sunaoka\LaravelFacadeGenerator\FacadeGeneratorServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            FacadeGeneratorServiceProvider::class,
        ];
    }
}
