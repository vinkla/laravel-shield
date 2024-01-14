# Laravel Shield

This package used to be an HTTP basic auth middleware for Laravel. However, it is now deprecated as I no longer use it personally. Laravel already has built-in basic auth support for their web guard. If you need a simple basic auth for your API, instead of depending on a third-party library, you can add it yourself. Please follow the guide below.

To begin, update your `.env` file with the following details:

```bash
BASIC_AUTH_USER=your-username
BASIC_AUTH_PASSWORD=your-password
```

Modify your `config/auth.php` file as follows:

```php
'basic' => [
    'user' => env('BASIC_AUTH_USER'),
    'password' => env('BASIC_AUTH_PASSWORD'),
],
```

Finally, create a middleware that resembles the code below:

```php
<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class BasicAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = config('auth.basic.user');
        $password = config('auth.basic.password');

        if (
            $request->getUser() !== $user ||
            $request->getPassword() !== $password
        ) {
            throw new UnauthorizedHttpException('Basic');
        }

        return $next($request);
    }
}
```

Add the middleware to your `app/Http/Kernel.php` file:

```php
protected $routeMiddleware = [
    'basic' => \App\Http\Middleware\BasicAuthMiddleware::class,
];
```

That's it! You can now use the middleware in your routes.

```php
Route::get('api/users', function () {
    return User::all();
})->middleware('basic');
```
