
# Laravel Eloquent Filter Package

## :inbox_tray: Installation


Require the package using composer:

```

composer require htetoozin/eloquent-filter

```

## Usage

Run php artisan make:filter {name} this will generate you a new file in `app/Filters` folders. eg..

```
php artisan make:filter UserFilter
```

Add local query scope in model.

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
And fitler class in your conroller. 
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