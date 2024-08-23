<?php

namespace ConnorLock05\LaravelAdmin\Requests;

use ConnorLock05\LaravelAdmin\Controllers\ModelController;
use ConnorLock05\LaravelAdmin\Interfaces\Type;
use ConnorLock05\LaravelAdmin\Services\ModelService;
use Illuminate\Foundation\Http\FormRequest;

class ModelUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $modelClass = request()->route('model');
        $modelClass = (new ModelController(new ModelService))->getModelClassName($modelClass);

        $fields = $modelClass::getModifiableFields();

        $rules = [];

        /**
         * @var string $field
         * @var Type $type
         */
        foreach ($fields as $field => $type)
        {
            $rules[$field] = $type->getUpdateRules();
        }

        return $rules;
    }
}