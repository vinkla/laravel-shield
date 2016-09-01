Laravel Shield
==============

![shield](https://cloud.githubusercontent.com/assets/499192/12594651/68d05fee-c477-11e5-9bd2-9a5df5fbc13b.png)

Shield is a HTTP basic auth middleware for Laravel and Lumen. No database required, instead we put the user credentials within the configuration file.

```php
// Use on your routes.
Route::get('/', ['middleware' => 'shield', function () {
    // Your protected page.
}]);

// Use it within your controller constructor.
$this->middleware('shield');

// Use specific user credentials.
$this->middleware('shield:hasselhoff');
```

[![Build Status](https://img.shields.io/travis/vinkla/laravel-shield/master.svg?style=flat)](https://travis-ci.org/vinkla/laravel-shield)
[![StyleCI](https://styleci.io/repos/50459201/shield?style=flat)](https://styleci.io/repos/50459201)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/vinkla/shield.svg?style=flat)](https://scrutinizer-ci.com/g/vinkla/shield/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/vinkla/shield.svg?style=flat)](https://scrutinizer-ci.com/g/vinkla/shield)
[![Latest Version](https://img.shields.io/github/release/vinkla/shield.svg?style=flat)](https://github.com/vinkla/shield/releases)
[![License](https://img.shields.io/packagist/l/vinkla/shield.svg?style=flat)](https://packagist.org/packages/vinkla/shield)

## Installation
Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require vinkla/shield
```

Add the service provider to `config/app.php` in the `providers` array.

```php
Vinkla\Shield\ShieldServiceProvider::class
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

The user credentials which are used when logging in with HTTP basic authentication. You can hash new user credentials by running the artisan command `shield:hash`.

## Usage

To protect your routes with the shield you can add it to the routes file.
```php
Route::get('/', ['middleware' => 'shield', function () {
    // Your protected page.
}]);
```

You can also add the shield middleware to your controllers constructor.
```php
$this->middleware('shield');
```

The middleware accepts one optional parameter to specify which user credentials to compared with.
```php
$this->middleware('shield:kitt');
```

To hash new user credentials, please use the command below. The command expects an array of items (separated with spaces).
```bash
php artisan shield:hash david hasselhoff
```

Then copy and paste the credentials to the `.env` file separating the hashed username and password with a colon.
```bash
SHIELD_USER=your-hashed-user
SHIELD_PASSWORD=your-hashed-password
```

## License

Laravel Shield is licensed under [The MIT License (MIT)](LICENSE).
