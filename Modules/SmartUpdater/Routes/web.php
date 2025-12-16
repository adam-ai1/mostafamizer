<?php

use Illuminate\Support\Facades\Route;
use Modules\SmartUpdater\Http\Controllers\SmartUpdaterController;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'locale', 'permission', 'web']], function () {
    Route::prefix('smart-updater')->group(function () {
        Route::get('/', [SmartUpdaterController::class, 'index'])->name('smart-updater.index');
        Route::post('/analyze', [SmartUpdaterController::class, 'analyze'])->name('smart-updater.analyze');
        Route::post('/install', [SmartUpdaterController::class, 'install'])->name('smart-updater.install');
        Route::get('/backups', [SmartUpdaterController::class, 'backups'])->name('smart-updater.backups');
        Route::post('/restore', [SmartUpdaterController::class, 'restore'])->name('smart-updater.restore');
        Route::post('/delete-backup', [SmartUpdaterController::class, 'deleteBackup'])->name('smart-updater.delete-backup');
        Route::post('/cleanup', [SmartUpdaterController::class, 'cleanup'])->name('smart-updater.cleanup');
    });
});
