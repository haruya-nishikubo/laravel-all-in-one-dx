<?php

use App\Http\Controllers\Admin\User\ExportController;
use App\Http\Controllers\Admin\User\ImportController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::post('user/import', ImportController::class)->name('user.import');
        Route::get('user/export', ExportController::class)->name('user.export');

        Route::resource('user', UserController::class);
    });
