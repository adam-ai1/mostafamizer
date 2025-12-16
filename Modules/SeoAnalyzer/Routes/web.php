<?php

use Illuminate\Support\Facades\Route;
use Modules\SeoAnalyzer\Http\Controllers\SeoAnalyzerController;

Route::prefix('seo-analyzer')->middleware(['auth', 'verified', 'locale'])->group(function() {
    Route::get('/', [SeoAnalyzerController::class, 'index'])->name('seo-analyzer.index');
    Route::post('/analyze', [SeoAnalyzerController::class, 'analyze'])->name('seo-analyzer.analyze');
});
