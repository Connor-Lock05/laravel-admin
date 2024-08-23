<?php

use ConnorLock05\LaravelAdmin\Controllers\AdminPanelController;
use ConnorLock05\LaravelAdmin\Controllers\ModelController;
use ConnorLock05\LaravelAdmin\Middleware\AdminPanelAccess;
use Illuminate\Support\Facades\Route;

Route::middleware(
    array_merge(
        config('laravel-admin.middleware', []),
        [AdminPanelAccess::class]
    )
)->group(function () {
    Route::prefix(config('laravel-admin.route_prefix', 'admin'))->group(function () {

        Route::get('/', [AdminPanelController::class, 'index'])->name('admin.dashboard');

        Route::prefix('{model}')->group(function () {
            Route::get('/', [ModelController::class, 'index'])->name('admin.model.index');

            Route::get('/{id}', [ModelController::class, 'show'])->whereNumber('id')
                ->name('admin.model.show');

            Route::get('/create', [ModelController::class, 'create'])->name('admin.model.create');
            Route::post('/', [ModelController::class, 'store'])->name('admin.model.store');

            Route::get('/{id}/edit', [ModelController::class, 'edit'])->whereNumber('id')
                ->name('admin.model.edit');
            Route::patch('/{id}', [ModelController::class, 'update'])->whereNumber('id')
                ->name('admin.model.update');

            Route::delete('/{id}', [ModelController::class, 'destroy'])->whereNumber('id')
                ->name('admin.model.destroy');
        });
    });
});