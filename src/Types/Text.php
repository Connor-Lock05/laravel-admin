<?php

namespace ConnorLock05\LaravelAdmin\Types;

class Text extends Field
{
    public function render(string $name, mixed $value = null): string
    {
        $classString = $this->getClassString();

        return <<< HTML
        <input 
            type="text" 
            name="{$name}" 
            id="{$name}_field" 
            value="{$value}"
            class="{$classString}" 
        />
        HTML;
    }

    public function getCreateRules(): array
    {
        return [
            'required',
        ];
    }

}