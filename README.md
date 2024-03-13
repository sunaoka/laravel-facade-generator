# Facade generator for Laravel

[![Latest Stable Version](https://poser.pugx.org/sunaoka/laravel-facade-generator/v/stable)](https://packagist.org/packages/sunaoka/laravel-facade-generator)
[![License](https://poser.pugx.org/sunaoka/laravel-facade-generator/license)](https://packagist.org/packages/sunaoka/laravel-facade-generator)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/sunaoka/laravel-facade-generator)](composer.json)
[![Laravel](https://img.shields.io/badge/laravel-%3E=%205.8-red)](https://laravel.com/)
[![Test](https://github.com/sunaoka/laravel-facade-generator/actions/workflows/test.yml/badge.svg)](https://github.com/sunaoka/laravel-facade-generator/actions/workflows/test.yml)
[![codecov](https://codecov.io/gh/sunaoka/laravel-facade-generator/branch/develop/graph/badge.svg)](https://codecov.io/gh/sunaoka/laravel-facade-generator)

----

It is an artisan console command that generates services, service providers and facades.

## Installation

```bash
composer require --dev sunaoka/laravel-facade-generator
```

## Usage

```bash
php artisan make:facade [Facade Name]
```

## Configurations

```bash
php artisan vendor:publish --tag=facade-generator-config
```

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Class names suffix
    |
    | Sets the string to be suffixed to the class name.
    |--------------------------------------------------------------------------
    */
    'suffix' => [
        'facade'   => '',
        'service'  => 'Service',
        'provider' => 'ServiceProvider',
    ],

    /*
    |--------------------------------------------------------------------------
    | Generate test
    |
    | If `false`, no test will be generated.
    |--------------------------------------------------------------------------
    */

    'test' => true,
];
```

## Example

```bash
php artisan make:facade Foo
```

### Generated: app/Facades/Foo.php

```php
<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Foo
 *
 * @method static \Mockery\MockInterface spy() Convert the facade into a Mockery spy.
 * @method static \Mockery\MockInterface partialMock() Initiate a partial mock on the facade.
 * @method static \Mockery\Expectation   shouldReceive(string|array ...$methodNames) Initiate a mock expectation on the facade.
 * @method static void                   swap($instance) Hotswap the underlying instance behind the facade.
 * @method static void                   clearResolvedInstance(string $name) Clear a resolved facade instance.
 * @method static void                   clearResolvedInstances() Clear all of the resolved instances.
 * 
 * @see \App\Services\FooService
 */
class Foo extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Foo';
    }
}
```

### Generated: app/Providers/FooServiceProvider.php

```php
<?php

namespace App\Providers;

use App\Services\FooService;
use Illuminate\Support\ServiceProvider;

class FooServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Foo', FooService::class);
    }
}
```

### Generated: app/Services/FooService.php

```php
<?php

namespace App\Services;

class FooService
{
}
```

and called `artisan make:test` to create `tests/Feature/FooServiceTest.php`.

### Laravel 5.8 to 10.x

You must add a providers and an aliases in `config/app.php`.

```php
'providers' => [
    App\Providers\FooServiceProvider::class,
],

'aliases' => [
    'Foo' => App\Facades\Foo::class,
],
```

### Laravel 11.x

You must add a providers in `bootstrap/providers.php`.

```php
return [
    App\Providers\FooServiceProvider::class,
];
```

and, You must add an aliases in `config/app.php`.

```php
'aliases' => [
    'Foo' => App\Facades\Foo::class,
],
```
