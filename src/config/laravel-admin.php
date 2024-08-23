<?php

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
    'middleware' => ['web', 'auth'],

    /*
    |---------------------------
    | Records Per Page
    |---------------------------
    |
    | The number of records to show per page in model list view
    |
     */
    'per_page' => 15,

];