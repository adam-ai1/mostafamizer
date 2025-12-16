<?php

use Illuminate\Support\Facades\Route;
use Modules\Presentation\Http\Controllers\PresentationController;

Route::prefix('presentation')->middleware(['auth', 'verified', 'locale'])->group(function() {
    Route::get('/', [PresentationController::class, 'index'])->name('presentation.index');
    Route::get('/create', [PresentationController::class, 'create'])->name('presentation.create');
    Route::post('/generate', [PresentationController::class, 'generate'])->name('presentation.generate');
    Route::get('/{id}', [PresentationController::class, 'show'])->name('presentation.show');
    Route::get('/{id}/download', [PresentationController::class, 'download'])->name('presentation.download');
});
