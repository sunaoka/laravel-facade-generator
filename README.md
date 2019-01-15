# Facade generator for Laravel 5

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

### app/Facades/Foo.php

```php
<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Foo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Foo';
    }
}
```

### app/Providers/FooServiceProvider.php

```php
<?php

namespace App\Providers;

use App\Services\FooService;
use Illuminate\Support\ServiceProvider;

class FooServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Foo', FooService::class);
    }
}
```

### app/Services/FooService.php

```php
<?php

namespace App\Services;

class FooService
{
}
```

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
