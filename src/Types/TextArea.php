<?php

namespace ConnorLock05\LaravelAdmin\Types;

class TextArea extends Field
{
    public function getInputClasses(): array
    {
        $classes = parent::getInputClasses();

        foreach ($classes as &$class)
        {
            if ($class == 'rounded-full')
            {
                $class = 'rounded-lg';
            }
        }

        return $classes;
    }

    public function render(string $name, mixed $value = null): string
    {
        $classString = $this->getClassString();
        $value = $value ?? '';

        return <<< HTML
        <textarea rows="5" class="{$classString}" name="{$name}" id="{$name}_field">{$value}</textarea>
        HTML;
    }

    public function getCreateRules(): array
    {
        return [
            'required',
        ];
    }

}