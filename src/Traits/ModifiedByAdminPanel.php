<?php

namespace ConnorLock05\LaravelAdmin\Traits;

use ConnorLock05\LaravelAdmin\Interfaces\Type;

trait ModifiedByAdminPanel
{
    /**
     * Returns a list of field and their types
     * for the Admin Panel to modify
     *
     * @return array<string, Type>
     */
    public abstract static function getModifiableFields(): array;

    /**
     * Returns a list of fields to display on
     * the list for the index view
     *
     * @return string[]
     */
    public abstract static function getFieldsForIndexView(): array;

}