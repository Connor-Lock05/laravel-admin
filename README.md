# Laravel Admin Panel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/connor-lock05/laravel-admin.svg?style=flat-square)](https://packagist.org/packages/connor-lock05/laravel-admin)
[![Total Downloads](https://img.shields.io/packagist/dt/connor-lock05/laravel-admin.svg?style=flat-square)](https://packagist.org/packages/connor-lock05/laravel-admin)
[![License](https://img.shields.io/packagist/l/connor-lock05/laravel-admin.svg?style=flat-square)](https://packagist.org/packages/connor-lock05/laravel-admin)

## Table of Contents

- [Introduction](#introduction)
- [Installation](#installation)
- [Usage](#usage)
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

To allow a model to be interacted with by the Admin panel, you need to use the `ConnorLock05\LaravelAdmin\Traits\ModifiedByAdminPanel` trait on a model
This will then require you to define two functions: `getModifiableFields` and `getFieldsForIndexView`

### getModifiableFields

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

### getFieldsForIndexView

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