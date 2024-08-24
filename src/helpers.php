<?php

namespace ConnorLock05\LaravelAdmin;

use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionException;

/**
 * @throws ReflectionException
 */
function classes_using_trait(string $traitName): array
{
    $classes = get_declared_classes();

    $classesUsingTrait = [];

    foreach ($classes as $class)
    {
        $reflection = new ReflectionClass($class);

        if (in_array($traitName, $reflection->getTraitNames()))
        {
            $classesUsingTrait[] = $class;
        }
    }

    return $classesUsingTrait;
}

/**
 * @throws ReflectionException
 */
function load_classes_from_namespace_prefix(string $namespacePrefix): void {
    // Get the list of all declared classes before any are loaded
    $declaredClasses = get_declared_classes();

    // Iterate over all files in the vendor/composer/autoload_classmap.php file
    $classMap = require base_path('vendor/composer/autoload_classmap.php');

    foreach ($classMap as $class => $file) {
        // Check if the class starts with the specified namespace
        if (str_starts_with($class, $namespacePrefix)) {
            // Skip classes that are already declared
            if (!in_array($class, $declaredClasses)) {
                // Use ReflectionClass to load the class
                new ReflectionClass($class);
            }
        }
    }
}

function get_formatted_class_name(string $class): string
{
    return Str::headline((new ReflectionClass($class))->getShortName());
}
