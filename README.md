# Laravel Admin Panel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/connor-lock05/laravel-admin.svg?style=flat-square)](https://packagist.org/packages/connor-lock05/laravel-admin)
[![Total Downloads](https://img.shields.io/packagist/dt/connor-lock05/laravel-admin.svg?style=flat-square)](https://packagist.org/packages/connor-lock05/laravel-admin)
[![License](https://img.shields.io/packagist/l/connor-lock05/laravel-admin.svg?style=flat-square)](https://packagist.org/packages/connor-lock05/laravel-admin)

## Table of Contents

- [Introduction](#introduction)
- [Installation](#installation)
- [Usage](#usage)
  - [Accessing the Admin Panel](#accessing-the-admin-panel)
  - [Setting Up Models](#setting-up-models)
- [Customisation](#customisation)
  - [Configuration](#configuration)
  - [Overriding Views](#overriding-views)
- [License](#license)

## Introduction

A Laravel Admin Panel for laravel applications providing a simple and easy to use interface to create, view, edit or delete model records.

## Installation

You can install the package via Composer:

```bash
composer require connor-lock05/laravel-admin
```
## Usage

### Accessing the admin panel

To access the admin panel there are two available methods of authorisation.

1. You can use the `ConnorLock05\LaravelAdmin\Middleware\RoleAuthorisation` middleware. 
    This will use the logged-in user to check they have the correct roles
    > Requires the spatie/laravel-permission package to be installed
2. Or you can use the `ConnorLock05\LaravelAdmin\Middleware\IpAuthorisation` middleware.
    This will use the ip origin for the request compared to a comma separated list of ip addresses defined in your .env file
    Define `ADMIN_ALLOWED_IPS` in your .env to a list of allowed IPs.
    i.e (`ADMIN_ALLOWED_IPS=127.0.0.1,127.0.0.2`)

#### When using RoleAuthorisation

1. Run through the installation process for spatie/laravel-permission [here](https://spatie.be/docs/laravel-permission/v6/installation-laravel)
2. You will need to add authentication middleware *before* the RoleAuthorisation middleware to ensure a user is logged in. Do this in the `laravel-admin.php` config file (See [Configuration](#configuration))
3. You will need to create a role for the admin panel access and add this to your config file.
  > See how to customise the admin config [here](#configuration)
  > 
  > By default, the 'Admin' role is allowed access to the admin panel.

Once logged in, visit /admin to get to the admin panel dashboard

### Setting Up Models

To allow a model to be interacted with by the Admin panel, you need to use the `ConnorLock05\LaravelAdmin\Traits\ModifiedByAdminPanel` trait on a model
This will then require you to define two functions: `getModifiableFields` and `getFieldsForIndexView`

#### getModifiableFields

The `getModifiableFields` function defines what fields are editable by the admin panel and the data type of the field.
This function returns an associative array with strings (column names) as keys, and `ConnorLock05\LaravelAdmin\Interfaces\Type` as values.

There are several types defined:
- `ConnorLock05\LaravelAdmin\Types\Text` This is a string field
- `ConnorLock05\LaravelAdmin\Types\Number` This is an integer field
- `ConnorLock05\LaravelAdmin\Types\Password` This is a password field, the value won't be added to the field on edit and if a value is not provided it will not be updated
- `ConnorLock05\LaravelAdmin\Types\Picklist` This is a select field, an array of options is provided on creation where keys are the option label and the value is the option value
- `ConnorLock05\LaravelAdmin\Types\TextArea` This is a text area field (intended for text column types)
- `ConnorLock05\LaravelAdmin\Types\Related` This is a related field, a model is provided on instantiation alongside an optional 'referenceColumn' which is the column name for the field to use as the option label (primary key column is default)

> Example

```php
public static function getModifiableFields(): array
{
    return [
        'title' => new Text(),
        'user_id' => new Related(User::class, 'name'),
        'body' => new TextArea()
    ];
}
```

#### getFieldsForIndexView

The `getFieldsForIndexView` function defines what fields are shown in the list on the index view.
This function returns a non-associative array of strings of column names to include

> Example

```php
public static function getFieldsForIndexView(): array
{
    return [
        'name',
        'email'
    ];
}
```

## Customisation

### Configuration

To publish the configuration for this package, run
```bash
php artisan vendor:publish --tag="admin-config"
```

### Overriding Views

To publish the views for overriding, run:
```bash
php artisan vendor:publish --tag="admin-views"
```

Views will be published to `resources/views/vendor/admin/`

## License

Laravel Admin is open-sourced software licensed under the MIT license.