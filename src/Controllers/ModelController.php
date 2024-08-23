<?php

namespace ConnorLock05\LaravelAdmin\Controllers;

use ConnorLock05\LaravelAdmin\Requests\ModelCreateRequest;
use ConnorLock05\LaravelAdmin\Requests\ModelUpdateRequest;
use ConnorLock05\LaravelAdmin\Services\ModelService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class ModelController extends Controller
{
    public function __construct(
        private ModelService $modelService
    )
    {
    }

    public function getModelClassName(string $model): string
    {
        return base64_decode($model);
    }

    public function index(string $model): View
    {
        $class = $this->getModelClassName($model);
        $records = $this->modelService->getModelRecords($class);
        $indexFields = $this->modelService->getModelIndexFields(new $class);

        return view('admin::model.index', compact(
            'records',
            'indexFields',
            'model',
        ));
    }

    public function show(string $model, int $id): View
    {
        $class = $this->getModelClassName($model);
        $record = $class::find($id);
        $fields = $class::getModifiableFields();

        return view('admin::model.show', compact(
            'model',
            'id',
            'record',
            'fields',
        ));
    }

    public function create(string $model): View
    {
        $class = $this->getModelClassName($model);
        $fields = $class::getModifiableFields();

        return view('admin::model.create', compact(
            'model',
            'fields'
        ));
    }

    public function store(ModelCreateRequest $request, string $model): RedirectResponse
    {
        $validated = $request->validated();
        $class = $this->getModelClassName($model);

        $instance = new $class;

        foreach ($validated as $field => $value)
        {
            $instance->$field = $value;
        }

        $instance->save();

        return redirect()->route('admin.model.index', [$model]);
    }

    public function edit(string $model, int $id): View
    {
        $class = $this->getModelClassName($model);
        $fields = $class::getModifiableFields();
        $record = $class::find($id);

        return view('admin::model.edit', compact(
            'model',
            'id',
            'fields',
            'record',
        ));
    }

    public function update(ModelUpdateRequest $request, string $model, int $id): RedirectResponse
    {
        $validated = $request->validated();

        $class = $this->getModelClassName($model);
        $record = $class::find($id);

        $validated = $this->modelService->removeNullValues($validated);

        foreach ($validated as $field => $value)
        {
            $record->$field = $value;
        }

        $record->save();

        return redirect()->route('admin.model.index', [$model]);
    }

    public function destroy(string $model, int $id): RedirectResponse
    {
        $class = $this->getModelClassName($model);

        $class::destroy($id);

        return redirect()->route('admin.model.index', [$model]);
    }
}