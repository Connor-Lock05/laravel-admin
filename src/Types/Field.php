<?php

namespace ConnorLock05\LaravelAdmin\Types;

use ConnorLock05\LaravelAdmin\Interfaces\Type;
use Illuminate\Database\Eloquent\Model;

abstract class Field implements Type
{
    public function getInputClasses(): array
    {
        return [
            'w-1/2',
            'border-black',
            'border',
            'bg-white',
            'rounded-full',
            'px-2',
            'py-1',
        ];
    }

    protected function getClassString(): string
    {
        return implode(' ', $this->getInputClasses());
    }

    public function renderValue(Model $model, string $field): mixed
    {
        return $model->$field;
    }

    public function getUpdateRules(): array
    {
        return $this->getCreateRules();
    }
}