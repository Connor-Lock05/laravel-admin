<?php

namespace ConnorLock05\LaravelAdmin\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface Type
{
    function render(string $name, mixed $value=null): string;

    function renderValue(Model $model, string $field): mixed;

    function getInputClasses(): array;

    function getCreateRules(): array;
    function getUpdateRules(): array;
}