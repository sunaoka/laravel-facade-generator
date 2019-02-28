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

    public function testMake()
    {
        $this->artisan('make:facade', ['name' => 'FacadeMakeTest'])
            ->expectsOutput('Facade created successfully.')
            ->assertExitCode(0);

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

        $this->artisan('make:facade', ['name' => 'FacadeMakeTest'])
            ->expectsOutput('Facade already exists!')
            ->assertExitCode(1);
    }
}
