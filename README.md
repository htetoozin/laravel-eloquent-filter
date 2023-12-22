
# Laravel Eloquent Filter Package

## :inbox_tray: Installation

You can install this package via composer using this command:

```

composer require htetoozin/eloquent-filter

```

## Usage


Run php artisan make:filter {name} this file generate and stored at the location of app/Filters/. eg..

```
php artisan make:filter UserFilter
```
will generate such file content of UserFilter.php 

[!NOTE]  
array value and method name must be same. eg.. keywords

```php
<?php

namespace App\Filters;

use HtetOoZin\EloquentFilter\Filters\Filter;

class UserFilter extends Filter
{
    /**
     * Register filter properties
     */
    protected $filters = ['keyword'];


    /**
     * Filter by keyword.
     */
    public function keyword($value)
    {
        return $this->builder->where('name', 'like', "%{$value}%");
    }
}
```

Add local query scope in related model.

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
Import UserFilter class to related controller.
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