# Facade generator for Laravel 5

[![Latest Stable Version](https://poser.pugx.org/sunaoka/laravel-facade-generator/v/stable)](https://packagist.org/packages/sunaoka/laravel-facade-generator)
[![License](https://poser.pugx.org/sunaoka/laravel-facade-generator/license)](https://packagist.org/packages/sunaoka/laravel-facade-generator)
[![Build Status](https://travis-ci.org/sunaoka/laravel-facade-generator.svg?branch=develop)](https://travis-ci.org/sunaoka/laravel-facade-generator)
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
 * @method static \Mockery\Expectation shouldReceive(...$methodNames)
 * @method static \Mockery\Mock        makePartial()
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

### add config/app.php

You must register a providers and an alias for the facade in `config/app.php'.

```php
'providers' => [
    App\Providers\FooServiceProvider::class,
],
'aliases' => [
    'Foo' => App\Facades\Foo::class,
],
```
