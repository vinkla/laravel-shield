![shield](https://cloud.githubusercontent.com/assets/499192/12594651/68d05fee-c477-11e5-9bd2-9a5df5fbc13b.png)

# Laravel Shield

> A [HTTP basic auth](https://en.m.wikipedia.org/wiki/Basic_access_authentication) middleware for Laravel.

```php
// Use on your routes.
Route::get('/', ['middleware' => 'shield'], function () {
    // Your protected page.
});

// Use it within your controller constructor.
$this->middleware('shield');

// Use specific user credentials.
$this->middleware('shield:hasselhoff');
```

[![Build Status](https://badgen.net/github/checks/vinkla/laravel-shield?label=build&icon=github)](https://github.com/vinkla/laravel-shield/actions)
[![Monthly Downloads](https://badgen.net/packagist/dm/vinkla/shield)](https://packagist.org/packages/vinkla/shield/stats)
[![Latest Version](https://badgen.net/packagist/v/vinkla/shield)](https://packagist.org/packages/vinkla/shield)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
composer require vinkla/shield
```

Add the middleware to the `$routeMiddleware` array in your `Kernel.php` file.

```php
'shield' => \Vinkla\Shield\ShieldMiddleware::class,
```

## Configuration

Laravel Shield requires configuration. To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish
```

This will create a `config/shield.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### HTTP Basic Auth Credentials

The user credentials which are used when logging in with [HTTP basic authentication](https://en.m.wikipedia.org/wiki/Basic_access_authentication).

## Usage

To protect your routes with the shield you can add it to the routes file.

```php
Route::get('/', ['middleware' => 'shield'], function () {
    // Your protected page.
});
```

You can also add the shield middleware to your controllers constructor.

```php
$this->middleware('shield');
```

The middleware accepts one optional parameter to specify which user credentials to compared with.

```php
$this->middleware('shield:kitt');
```

To add a new user, you probably want to use hashed credentials. Hashed credentials can be generated with the [`password_hash()`](https://secure.php.net/manual/en/function.password-hash.php) function in the terminal:

```sh
php -r "echo password_hash('my-secret-passphrase', PASSWORD_DEFAULT);"
```

Then copy and paste the hashed credentials to the `.env` environment file.

```bash
SHIELD_USER=your-hashed-user
SHIELD_PASSWORD=your-hashed-password
```
