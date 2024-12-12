<?php

namespace Sunaoka\LaravelFacadeGenerator\Tests;

class FacadeMakeTest extends TestCase
{
    protected function tearDown(): void
    {
        \File::delete([
            app_path('Facades/FacadeMakeTest.php'),
            app_path('Services/FacadeMakeTestService.php'),
            app_path('Providers/FacadeMakeTestServiceProvider.php'),
            base_path('tests/Feature/FacadeMakeTestServiceTest.php'),
        ]);

        parent::tearDown();
    }

    public function test_make(): void
    {
        if (version_compare($this->app->version(), '9.2.0') < 0) {
            $this->artisan('make:facade', ['name' => 'FacadeMakeTest'])
                ->expectsOutput('Facade created successfully.')
                ->assertExitCode(0);
        } else {
            $this->artisan('make:facade', ['name' => 'FacadeMakeTest'])
                ->expectsOutputToContain('created successfully')
                ->assertExitCode(0);
        }

        $this->assertFileEquals(
            __DIR__.'/stubs/FacadeMakeTest.stub',
            app_path('Facades/FacadeMakeTest.php')
        );

        $this->assertFileEquals(
            __DIR__.'/stubs/FacadeMakeTestService.stub',
            app_path('Services/FacadeMakeTestService.php')
        );

        $this->assertFileEquals(
            __DIR__.'/stubs/FacadeMakeTestServiceProvider.stub',
            app_path('Providers/FacadeMakeTestServiceProvider.php')
        );

        $this->assertFileExists(base_path('tests/Feature/FacadeMakeTestServiceTest.php'));

        if (version_compare($this->app->version(), '9.2.0') < 0) {
            $this->artisan('make:facade', ['name' => 'FacadeMakeTest'])
                ->expectsOutput('Facade already exists!')
                ->assertExitCode(0);
        } else {
            $this->artisan('make:facade', ['name' => 'FacadeMakeTest'])
                ->expectsOutputToContain('already exists')
                ->assertExitCode(0);
        }
    }
}
