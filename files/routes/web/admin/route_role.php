<?php

use App\Http\Controllers\Admin\RouteRole\ExportController;
use App\Http\Controllers\Admin\RouteRole\ImportController;
use App\Http\Controllers\Admin\RouteRole\RoutePolicyController;
use App\Http\Controllers\Admin\RouteRole\UserController;
use App\Http\Controllers\Admin\RouteRoleController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::post('route_role/import', ImportController::class)->name('route_role.import');
        Route::get('route_role/export', ExportController::class)->name('route_role.export');

        Route::resource('route_role.user', UserController::class)
            ->only([
                'create',
                'store',
            ]);

        Route::resource('route_role.route_policy', RoutePolicyController::class)
            ->only([
                'create',
                'store',
            ]);

        Route::resource('route_role', RouteRoleController::class);
    });
