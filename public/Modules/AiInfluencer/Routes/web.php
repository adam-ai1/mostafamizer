<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('user')->middleware(['auth', 'locale', 'web'])->name('user.')->group(function () {
    Route::group(['as' => 'ai-shorts.', 'prefix' => 'ai-shorts', 'controller' =>  \Modules\AiInfluencer\Http\Controllers\Customer\AiShortsController::class, 'middleware' => ['userPermission:hide_ai_product_photography']], function () {
        Route::get('/', 'template')->name('template')->middleware(['teamAccess:video']);
        Route::post('/store', 'store')->name('store')->middleware(['checkForDemoMode', 'teamAccess:video,api']);
    });

    Route::group(['as' => 'url-to-video.', 'prefix' => 'url-to-video', 'controller' =>  \Modules\AiInfluencer\Http\Controllers\Customer\UrlToVideoController::class, 'middleware' => ['userPermission:hide_ai_product_photography']], function () {
        Route::get('/', 'template')->name('template')->middleware(['teamAccess:video']);
        Route::post('/store', 'store')->name('store')->middleware(['checkForDemoMode', 'teamAccess:video,api']);
    });

    Route::group(['as' => 'influencer-avatar.', 'prefix' => 'influencer-avatar', 'controller' =>  \Modules\AiInfluencer\Http\Controllers\Customer\InfluencerAvatarController::class, 'middleware' => ['userPermission:hide_ai_product_photography']], function () {
        Route::get('/', 'template')->name('template')->middleware(['teamAccess:video']);
        Route::post('/store', 'store')->name('store')->middleware(['checkForDemoMode', 'teamAccess:video,api']);
    });
});

Route::middleware(['auth', 'locale', 'web'])->prefix('admin')->group(function () {
    Route::name('admin.features.')->group(callback: function () {
        Route::group(['prefix' => 'ai-influencer', 'as' => 'ai-influencer.', 'controller' => \Modules\AiInfluencer\Http\Controllers\Admin\AiInfluencerController::class], function() {
            Route::get('/', 'index')->name('index');
            Route::delete('/delete/{id}', 'destroy')->middleware(['checkForDemoMode'])->name('delete');
        });
    });
});
