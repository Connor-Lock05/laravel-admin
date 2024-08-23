<?php

namespace ConnorLock05\LaravelAdmin\Exceptions;

use Exception;
use Spatie\Permission\Traits\HasRoles;
use Throwable;

class UserDoesntHaveRoles extends Exception
{
    public function __construct(string $className)
    {
        $message = "$className does not have the " . HasRoles::class . " trait";

        parent::__construct($message, 0, null);
    }
}