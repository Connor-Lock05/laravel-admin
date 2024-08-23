<?php

namespace ConnorLock05\LaravelAdmin\Types;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Related extends Field
{
    private Collection $options;
    private string $primaryKeyName;

    /**
     * @param string $relatedModel Model to get records from
     * @param string|null $referenceColumn Column to use for label, defaults to primary key column
     */
    public function __construct(
        private string $relatedModel,
        private string|null $referenceColumn = null,
    )
    {
        $this->primaryKeyName = (new $this->relatedModel)->getKeyName();

        if ($this->referenceColumn === null)
        {
            $this->referenceColumn = $this->primaryKeyName;
        }

        $this->options = $this->relatedModel::orderBy($this->referenceColumn)->get([$this->primaryKeyName, $this->referenceColumn]);
    }

    public function render(string $name, mixed $value = null): string
    {
        $classString = $this->getClassString();

        $html = <<< HTML
        <select name="{$name}" id="{$name}_field" class="{$classString}">
        HTML;

        foreach ($this->options as $option) {
            $selected = $option->{$this->primaryKeyName} == $value ? "selected" : "";
            $html .= "<option value='{$option->{$this->primaryKeyName}}' {$selected}>{$option->{$this->referenceColumn}}</option>";
        }

        $html .= "</select>";

        return $html;
    }

    public function getCreateRules(): array
    {
        return [
            'required',
            'exists:' . $this->relatedModel . ',' . $this->primaryKeyName,
        ];
    }

    public function renderValue(Model $model, string $field): mixed
    {
        return $this->relatedModel::find($model->$field)->{$this->referenceColumn};
    }

}