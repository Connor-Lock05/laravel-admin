<?php

namespace ConnorLock05\LaravelAdmin\Services;

use ConnorLock05\LaravelAdmin\Traits\ModifiedByAdminPanel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use ReflectionClass;
use function ConnorLock05\LaravelAdmin\classes_using_trait;

class ModelService
{
    public function getModelRecords(string $model): LengthAwarePaginator
    {
        // Validate class string
        $reflection = new ReflectionClass($model);
        $instance = new $model;
        if (
            (!$instance instanceof Model) ||
            (!in_array(ModifiedByAdminPanel::class, $reflection->getTraitNames()))
        ) {
            throw new \ErrorException("Invalid model $model provided to admin panel. Models should extend " . Model::class . " and use the " . ModifiedByAdminPanel::class . " trait.");
        }

        /** @var LengthAwarePaginator $paginator */
        $paginator = $model::orderBy($instance->getKeyName())
            ->paginate(config('laravel-admin.per_page', 15), $this->getModelIndexFields($instance));

        return $paginator;
    }

    public function getModelIndexFields(Model $model): array
    {
        return array_merge(
            [
                $model->getKeyName(),
            ],
            $model->getFieldsForIndexView()
        );
    }

    public function removeNullValues(array $input): array
    {
        return array_filter($input, function ($value) {
            return !is_null($value);
        });
    }

    public function getModels(): array
    {
        $usingTrait = classes_using_trait(ModifiedByAdminPanel::class);

        $modelsUsingTrait = [];

        foreach ($usingTrait as $class)
        {
            if ((new $class) instanceof Model)
            {
                $modelsUsingTrait[] = $class;
            }
        }

        return $modelsUsingTrait;
    }
}