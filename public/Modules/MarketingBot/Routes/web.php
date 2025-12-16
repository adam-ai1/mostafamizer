<?php

use Illuminate\Support\Facades\Route;
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

Route::prefix('user')->middleware(['auth', 'locale', 'web', 'userPermission:marketing_bot', 'teamAccess:marketing_bot'])->name('user.')->group(function () {
    Route::group(['as' => 'marketing-bot.', 'prefix' => 'marketing-bot'], function () {
        
        // Marketing Bot
        Route::group(['controller' =>  \Modules\MarketingBot\Http\Controllers\MarketingBotController::class], function () {
            Route::get('dashboard', 'template')->name('template');
            Route::get('inbox', 'inbox')->name('inbox');
            Route::get('conversation/{id}/messages', 'getAllMessages')->name('getAllMessages');
            Route::post('conversation/{id}/send/message', 'sendMessage')->name('sendMessage')->middleware(['checkForDemoMode']);
            Route::post('conversation/{id}/update/auto-reply', 'updateAutoReply')->name('updateAutoReply')->middleware(['checkForDemoMode']);
            Route::delete('conversation/{id}/delete', 'deleteChat')->name('deleteChat')->middleware(['checkForDemoMode']);
            
            Route::get('settings', 'settings')->name('settings');
            Route::post('settings/save', 'storeSettings')->name('store-settings')->middleware(['checkForDemoMode']);

            // contacts
            Route::get('contacts', 'contacts')->name('contacts')->middleware('channelEnabled:whatsapp');
            Route::get('get-contacts-dropdown', 'getContactsForDropdown')->name('contacts.dropdown')->middleware('channelEnabled:whatsapp');
            Route::post('store-contact', 'storeContact')->name('contacts.store')->middleware(['checkForDemoMode', 'channelEnabled:whatsapp']);
            Route::get('contacts/{id}', 'showContact')->name('contacts.show')->middleware('channelEnabled:whatsapp');
            Route::put('contacts/{id}', 'updateContact')->name('contacts.update')->middleware(['checkForDemoMode', 'channelEnabled:whatsapp']);
            Route::delete('delete-contact/{id}', 'deleteContact')->name('contacts.delete')->middleware(['checkForDemoMode', 'channelEnabled:whatsapp']);
            Route::get('contact/export', 'exportContact')->name('contact.export')->middleware('channelEnabled:whatsapp');
            Route::post('contact/import', 'importContact')->name('contact.import')->middleware(['checkForDemoMode', 'channelEnabled:whatsapp']);

            // Segment
            Route::get('segments', 'segments')->name('segments')->middleware('throttle:30,1', 'channelEnabled:whatsapp');
            Route::get('get-segments-dropdown', 'getSegmentsForDropdown')->name('segments.dropdown')->middleware('channelEnabled:whatsapp');
            Route::post('create-segment', 'storeSegment')->name('segments.store')->middleware(['checkForDemoMode', 'channelEnabled:whatsapp']);
            Route::put('update-segment/{id}', 'updateSegment')->name('segments.update')->middleware(['checkForDemoMode', 'channelEnabled:whatsapp']);
            Route::delete('segments/{id}', 'deleteSegment')->name('segments.delete')->middleware(['checkForDemoMode', 'channelEnabled:whatsapp']);
            Route::get('segments/export', 'segmentExport')->name('segments.export')->middleware('channelEnabled:whatsapp');

            Route::get('subscribers', 'subscribers')->name('subscribers')->middleware('channelEnabled:telegram');
            Route::get('subscribers/export', 'subscriberExport')->name('subscribers.export')->middleware('channelEnabled:telegram');
            Route::delete('subscriber/delete', 'deleteSubscriber')->name('deleteSubscriber')->middleware(['checkForDemoMode', 'channelEnabled:telegram']);

            Route::get('groups', 'groups')->name('groups')->middleware('channelEnabled:telegram');
            Route::get('group/export', 'groupExport')->name('groups.export')->middleware('channelEnabled:telegram');
            Route::delete('group/delete', 'deleteGroup')->name('deleteGroup')->middleware(['checkForDemoMode', 'channelEnabled:telegram']);

            Route::get('settings', 'settings')->name('settings');

            // chart data
            Route::get('campaign-performance/{days}', 'getCampaignPerformance')->name('campaign-performance');
            Route::get('conversions', 'getConversions')->name('conversions');
            Route::get('contact-growth', 'getContactGrowth')->name('contact-growth');
            Route::get('channel-distribution', 'getChannelDistribution')->name('channel-distribution');
        });

        // Campaigns
        Route::group(['as' => 'campaigns.', 'prefix' => 'campaigns', 'controller' => \Modules\MarketingBot\Http\Controllers\CampaignController::class], function () {
            Route::get('/', 'campaigns')->name('index');

            Route::get('whatsapp/create', 'createWhatsappCampaign')->name('whatsapp-campaign.create')->middleware('channelEnabled:whatsapp');
            Route::get('whatsapp/template/{id}', 'getTemplate')->name('whatsapp-template')->middleware('channelEnabled:whatsapp');
            Route::post('whatsapp/store', 'whatsappCampaignStore')->name('whatsapp-campaign.store')->middleware(['checkForDemoMode', 'channelEnabled:whatsapp']);

            Route::get('{id}/edit', 'campaignEdit')->name('edit');
            Route::put('{id}', 'campaignUpdate')->name('update')->middleware(['checkForDemoMode']);
            Route::get('export', 'exportCampaigns')->name('campaign.export');


            Route::get('telegram/create', 'createTelegramCampaign')->name('telegram-campaign.create')->middleware('channelEnabled:telegram');
            Route::post('telegram/store', 'telegramCampaignStore')->name('telegram-campaign.store')->middleware(['checkForDemoMode', 'channelEnabled:telegram']);

            Route::delete('delete/{id}', 'deleteTelegramCampaign')->name('telegram-campaign.delete')->middleware(['checkForDemoMode']);
        });

        // Campaign's materials
        Route::group(['as' => 'campaigns.', 'prefix' => 'campaigns', 'controller' => \Modules\MarketingBot\Http\Controllers\MaterialsController::class], function () {
            Route::get('material/{id}', 'materials')->name('materials');
            Route::get('fetch-website-url', 'fetchUrl')->name('fetch-url');
            Route::post('train/{id}', 'train')->name('train')->middleware(['checkForDemoMode']);

            Route::post('training-materials/export', 'exportTrainingMaterials')->name('material.export')->middleware(['checkForDemoMode']);
            Route::post('train-materials/{id}', 'trainMaterials')->name('trainMaterials')->middleware(['checkForDemoMode']);
            Route::delete('materials/delete', 'deleteMaterials')->name('deleteMaterials')->middleware(['checkForDemoMode']);
        });

        // Templates
        Route::group(['as' => 'templates.', 'prefix' => 'templates', 'controller' => \Modules\MarketingBot\Http\Controllers\TemplateController::class], function () {
            Route::get('', 'index')->name('index');
            Route::post('sync', 'sync')->name('create')->middleware(['checkForDemoMode', 'channelEnabled:whatsapp']);
            Route::delete('delete/{id}', 'delete')->name('delete')->middleware(['checkForDemoMode', 'channelEnabled:whatsapp']);
        });
        
    });
});

Route::match(['GET', 'POST'], 'marketing-bot/campaigns/whatsapp/webhook/handle', [\Modules\MarketingBot\Http\Controllers\CampaignController::class, 'whatsappWebhook'])->name('whatsapp.webhook')->withoutMiddleware([
    \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
]);

Route::post('marketing-bot/campaigns/telegram/webhook/handle/{id}', [\Modules\MarketingBot\Http\Controllers\CampaignController::class, 'telegramWebhook'])->name('telegram.webhook')->withoutMiddleware([
    \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
]);

// Queue worker for Marketing Bot
Route::get('marketing-bot/campaigns/queue/worker', [\Modules\MarketingBot\Http\Controllers\MarketingBotController::class, 'queueWorker'])->name('marketing-bot.queue.worker');  