
# Laravel Eloquent Filter Package

## :inbox_tray: Installation

You can install this package via composer using this command:

```

composer require htetoozin/eloquent-filter

```

## Usage

Run php artisan make:filter {name} this will generate you a new file in `app/Filters` folders. eg..

```
php artisan make:filter UserFilter
```

1- Add local query scope in model.

```php

<?php

class User extends Model
{
    public function scopeFilter($query, $filter)
    {
        $filter->apply($query);
    }
}
```
2- Import UserFilter class to related controller.
```php

<?php

use App\Filters\UserFilter;

class UserController extends Controller
{
    public function index(UserFilter $filter)
    {
        return User::filter($filter)->get();
    }
}
```

## :scroll: License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.