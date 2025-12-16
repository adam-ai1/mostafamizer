<?php

use Illuminate\Support\Facades\Route;
use Modules\VoxChat\Http\Controllers\VoxChatController;

/*
|--------------------------------------------------------------------------
| VoxChat Web Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => ['auth', 'locale', 'web']
], function () {
    
    Route::group([
        'prefix' => 'voxchat',
        'as' => 'voxchat.',
    ], function () {
        // Main chat interface
        Route::get('/', [VoxChatController::class, 'index'])->name('index');
        
        // API endpoints
        Route::post('/new', [VoxChatController::class, 'newConversation'])->name('new');
        Route::get('/conversation/{id}', [VoxChatController::class, 'loadConversation'])->name('load');
        Route::post('/send', [VoxChatController::class, 'sendMessage'])->name('send');
        Route::post('/voice', [VoxChatController::class, 'sendVoiceMessage'])->name('voice');
        Route::get('/audio/{filename}', [VoxChatController::class, 'serveAudio'])->name('audio');
        Route::post('/realtime/session', [VoxChatController::class, 'createRealtimeSession'])->name('realtime.session');
        Route::delete('/conversation/{id}', [VoxChatController::class, 'deleteConversation'])->name('delete');
        Route::get('/history', [VoxChatController::class, 'getHistory'])->name('history');
        Route::get('/suggestions', [VoxChatController::class, 'getSuggestions'])->name('suggestions');
    });
    
});
