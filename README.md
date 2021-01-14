# Laravel admin

[![Latest Stable Version](https://poser.pugx.org/michaeldojcar/laravel-admin/v)](//packagist.org/packages/michaeldojcar/laravel-admin) [![Total Downloads](https://poser.pugx.org/michaeldojcar/laravel-admin/downloads)](//packagist.org/packages/michaeldojcar/laravel-admin) [![Latest Unstable Version](https://poser.pugx.org/michaeldojcar/laravel-admin/v/unstable)](//packagist.org/packages/michaeldojcar/laravel-admin) [![License](https://poser.pugx.org/michaeldojcar/laravel-admin/license)](//packagist.org/packages/michaeldojcar/laravel-admin)

Pretty simple and also quite pretty admin panel for your Laravel app.

## Get started

```
composer require michaeldojcar/laravel-admin
```

Run migrations included in package.
```
php artisan migrate
```

Add routes to your `routes/web.php`.
```
Admin::routes(['register' => false]);
```


Publish config and assets.
```
php artisan vendor:publish --provider="MichaelDojcar\LaravelAdmin\Providers\AdminServiceProvider"
```

### Create first user
Create first admin user using this command.
```
php artisan admin:user
```