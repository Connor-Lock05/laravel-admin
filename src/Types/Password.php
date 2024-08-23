<?php

namespace ConnorLock05\LaravelAdmin\Types;

use Illuminate\Database\Eloquent\Model;

class Password extends Field
{
    public function render(string $name, mixed $value = null): string
    {
        $classString = $this->getClassString();

        return <<< HTML
        <input type="password" name="{$name}" id="{$name}_field" class="{$classString}" />
        HTML;
    }

    public function getCreateRules(): array
    {
        return [
            'required',
        ];
    }

    public function getUpdateRules(): array
    {
        return [
            'nullable'
        ];
    }

    public function renderValue(Model $model, string $field): mixed
    {
        return "**********";
    }
}