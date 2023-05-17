<?php

use App\Http\Controllers\Admin\RoutePolicy\ExportController;
use App\Http\Controllers\Admin\RoutePolicy\ImportController;
use App\Http\Controllers\Admin\RoutePolicyController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::post('route_policy/import', ImportController::class)->name('route_policy.import');
        Route::get('route_policy/export', ExportController::class)->name('route_policy.export');

        Route::resource('route_policy', RoutePolicyController::class);
    });
