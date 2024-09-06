<?php

use ConnorLock05\LaravelAdmin\Middleware\RoleAuthorisation;
use ConnorLock05\LaravelAdmin\Middleware\IpAuthorisation;

return [

    /*
    |---------------------------
    | Allowed Roles
    |---------------------------
    |
    | A list of the allowed roles to access the admin panel
    | Set to ['*'] to allow all
    |
     */
    'allowed_roles' => [
        'Admin'
    ],

    /*
    |---------------------------
    | Route Prefix
    |---------------------------
    |
    | The prefix for all admin panel route
    | 'admin' by default
    |
     */
    'route_prefix' => 'admin',

    /*
    |---------------------------
    | Route Middleware
    |---------------------------
    |
    | An array of middleware to apply to the admin routes
    |
     */
    'middleware' => [IpAuthorisation::class],

    /*
    |---------------------------
    | Records Per Page
    |---------------------------
    |
    | The number of records to show per page in model list view
    |
     */
    'per_page' => 15,

    /*
    |---------------------------
    | Allowed Ips
    |---------------------------
    |
    | A list of allowed Ips to access the admin panel
    | Used when using IpAuthorisation Middleware
    |
     */
    'allowed_ips' => explode(',', env('ADMIN_ALLOWED_IPS', '127.0.0.1')),

    /*
    |---------------------------
    | PHP Executable
    |---------------------------
    |
    | Full path to, or name of, PHP Executable
    |
     */
    'php_executable' => 'php'

];