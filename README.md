Laravel Shield
==============

![shield](https://cloud.githubusercontent.com/assets/499192/12594651/68d05fee-c477-11e5-9bd2-9a5df5fbc13b.png)

Shield is a HTTP basic auth middleware for Laravel and Lumen. No database required, instead we put the user credentials within the environment file.

```php
// Use on your routes.
Route::get('/', ['middleware' => 'shield', function () {
    // Your protected page.
}]);

// Use it within your controller constructor.
$this->middleware('shield');

// Specify specific user credentials.
$this->middleware('shield:hasselhoff');
```

[![Build Status](https://img.shields.io/travis/vinkla/shield/master.svg?style=flat)](https://travis-ci.org/vinkla/shield)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/vinkla/shield.svg?style=flat)](https://scrutinizer-ci.com/g/vinkla/shield/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/vinkla/shield.svg?style=flat)](https://scrutinizer-ci.com/g/vinkla/shield)
[![Latest Version](https://img.shields.io/github/release/vinkla/shield.svg?style=flat)](https://github.com/vinkla/shield/releases)
[![License](https://img.shields.io/packagist/l/vinkla/shield.svg?style=flat)](https://packagist.org/packages/vinkla/shield)

## Installation
Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
composer require vinkla/shield
```

Add the service provider to `config/app.php` in the `providers` array.

```php
Vinkla\Shield\ShieldServiceProvider::class
```

Add the middleware to the `$routeMiddleware` array in your `Kernel.php` file.

```php
protected $routeMiddleware = [
    'shield' => \Vinkla\Shield\ShieldMiddleware::class,
];
```

## Configuration

Laravel Shield requires configuration. To get started, you'll need to publish all vendor assets:

```bash
php artisan vendor:publish
```

This will create a `config/shield.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### HTTP Basic Auth Credentials

The user credentials which are used when logging in with HTTP basic authentication. You can generate new credentials by running the artisan command `shield:generate`.

## License

Laravel Shield is licensed under [The MIT License (MIT)](LICENSE).
