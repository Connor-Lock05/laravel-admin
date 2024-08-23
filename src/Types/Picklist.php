<?php

namespace ConnorLock05\LaravelAdmin\Types;

class Picklist extends Field
{
    public function __construct(private array $options)
    {
    }

    public function render(string $name, mixed $value = null): string
    {
        $classString = $this->getClassString();

        $html = <<< HTML
        <select name="{$name}" id="{$name}_field" class="{$classString}">
        HTML;

        foreach ($this->options as $label => $optionValue) {
            $selected = $optionValue == $value ? "selected" : "";
            $html .= "<option value='{$optionValue}' {$selected}>{$label}</option>";
        }

        $html .= "</select>";

        return $html;
    }

    public function getCreateRules(): array
    {
        return [
            'required',
            'in:' . implode(',', array_values($this->options)),
        ];
    }
}