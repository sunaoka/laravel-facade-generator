<?php

namespace Sunaoka\LaravelFacadeGenerator\Tests;

class FacadeMakeTest extends TestCase
{
    public function tearDown(): void
    {
        \File::delete([
            app_path('Facades/FacadeMakeTest.php'),
            app_path('Services/FacadeMakeTestService.php'),
            app_path('Providers/FacadeMakeTestServiceProvider.php'),
            dirname(app_path('')) . '/tests/Feature/FacadeMakeTestServiceTest.php',
        ]);

        parent::tearDown();
    }

    public function testMake(): void
    {
        if (version_compare($this->app->version(), '9.2.0') < 0) {
            $this->artisan('make:facade', ['name' => 'FacadeMakeTest'])
                ->expectsOutput('created successfully')
                ->assertExitCode(0);
        } else {
            $this->artisan('make:facade', ['name' => 'FacadeMakeTest'])
                ->expectsOutputToContain('created successfully')
                ->assertExitCode(0);
        }

        $this->assertFileEquals(
            __DIR__ . '/stubs/FacadeMakeTest.stub',
            app_path('Facades/FacadeMakeTest.php')
        );

        $this->assertFileEquals(
            __DIR__ . '/stubs/FacadeMakeTestService.stub',
            app_path('Services/FacadeMakeTestService.php')
        );

        $this->assertFileEquals(
            __DIR__ . '/stubs/FacadeMakeTestServiceProvider.stub',
            app_path('Providers/FacadeMakeTestServiceProvider.php')
        );

        $this->assertFileExists(dirname(app_path('')) . '/tests/Feature/FacadeMakeTestServiceTest.php');

        if (version_compare($this->app->version(), '9.2.0') < 0) {
            $this->artisan('make:facade', ['name' => 'FacadeMakeTest'])
                ->expectsOutput('already exists')
                ->assertExitCode(1);
        } else {
            $this->artisan('make:facade', ['name' => 'FacadeMakeTest'])
                ->expectsOutputToContain('already exists')
                ->assertExitCode(1);
        }
    }
}
