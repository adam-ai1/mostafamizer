<?php

use Modules\OpenAI\Http\Controllers\Admin\v2\ImageController as AdminV2ImageController;
use Modules\OpenAI\Http\Controllers\Admin\v2\AiChatbotController;
use Illuminate\Support\Facades\Route;
use Modules\OpenAI\Http\Controllers\Admin\{
    UseCasesController,
    UseCaseCategoriesController,
    OpenAIController,
    ChatCategoriesController,
    ChatAssistantsController,
    SpeechToTextController,
    LongArticleController as AdminLongArticleController,
    ProviderManageController,
    PrebuiltTemplateContentController,
    VoiceoverController as AdminVoiceoverController,
    FeaturePreferenceController,
    ImportController,
    CodeController
};
use Modules\OpenAI\Http\Controllers\Customer\{
    OpenAIController as UserAIController,
    SpeechToTextController as UserSpeechToTextController,
    UseCasesController as CustomerUseCasesController,
    DocumentsController as CustomerDocumentsController,
    CodeController as CustomerCodeController,
    FolderController,
    LongArticleController,
    PrebuiltTemplateContentController as CustomerPrebuiltTemplateContentController,
    VoiceoverController,
};
use Modules\OpenAI\Http\Controllers\Api\V1\Admin\{
    OpenAIController as AdminAPI,
};
use Modules\OpenAI\Http\Controllers\Api\V1\User\{
    UseCasesController as UseCasesControllerAPI,
    UseCaseCategoriesController as UseCaseCategoriesControllerAPI,
    UserController as UserControllerAPI,
};

use Modules\OpenAI\Http\Controllers\Api\v2\User\{
    ChatBotController,
    DocChatController as DocChatControllerAPI,
    ImageToVideoController as ImageToVideoControllerAPI,
    ChatBotWidgetController,
    ChatBotTrainingController,
    UserAccessController as UserAccessControllerAPI,
    FeatureManagerController,
    VoiceoverController as VoiceoverControllerAPI,
    TemplateController,
    AiDocChatController,
    FeaturePreferenceController as FeaturePreferenceAPI
};

use Modules\OpenAI\Http\Controllers\Api\v3\User\FeatureManagerController as V3FeatureManagerController;

use Modules\OpenAI\Http\Controllers\Customer\v2\GalleryController;
use Modules\OpenAI\Http\Controllers\Customer\v2\ImageController as V2ImageController;

use Modules\OpenAI\Http\Controllers\Customer\v2\PlagiarismController;
use Modules\OpenAI\Http\Controllers\Api\v2\User\VisionController;
use Modules\OpenAI\Http\Controllers\Customer\v2\AiDetectorController;

use Modules\OpenAI\Http\Controllers\Customer\v2\VoiceCloneController;
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


Route::group(['middleware' => ['web']], function () {
    Route::get('images/share/{slug}', [V2ImageController::class, 'imageShare'])->name('user.image.share');
});

//template
Route::middleware(['web', 'middleware' => 'userPermission:hide_template'])->group(function () {
    Route::get('/user/templates/', [UserAIController::class, 'templates'])->name('openai')->middleware(['auth', 'locale', 'teamAccess:template']);
});
Route::prefix('user')->middleware(['auth', 'locale', 'web'])->name('user.')->group(function () {
    //template
    Route::middleware(['middleware' => 'userPermission:hide_template'])->group(function () {
        Route::get('documents', [CustomerPrebuiltTemplateContentController::class, 'documents'])->name('documents');
        Route::get('favourite-documents', [CustomerPrebuiltTemplateContentController::class, 'favouriteDocuments'])->name('favouriteDocuments');
        Route::get('templates/{slug}', [CustomerPrebuiltTemplateContentController::class, 'template'])->name('template')->middleware('teamAccess:template');
        Route::get('formfiled-usecase/{slug}', [CustomerPrebuiltTemplateContentController::class, 'getFormFiledByUsecase'])->name('formField');
        Route::get('get-content', [CustomerPrebuiltTemplateContentController::class, 'getContent']);
        Route::delete('delete-content', [CustomerPrebuiltTemplateContentController::class, 'deleteContent'])->name('deleteContent');
        Route::get('content/edit/{slug}', [CustomerPrebuiltTemplateContentController::class, 'editContent'])->name('editContent');
        Route::post('update-content', [CustomerPrebuiltTemplateContentController::class, 'updateContent'])->name('updateContent');
    });

    // Text To Speech
    Route::middleware(['middleware' => 'userPermission:hide_text_to_speech'])->group(function () {
        Route::get('voiceovers', [VoiceoverController::class, 'index'])->name('voiceoverList');
        Route::get('voiceover', [VoiceoverController::class, 'template'])->name('voicoverTemplate')->middleware('teamAccess:voiceover');
        Route::get('voiceover/view/{id}', [VoiceoverController::class, 'show'])->name('voiceoverView');
        Route::post('voiceover/delete', [VoiceoverController::class, 'delete'])->name('voiceoverDelete');
        Route::post('voiceover/destroy', [VoiceoverController::class, 'destroy'])->name('voiceoverDestroy');

        Route::get('formfiled-voiceover', [VoiceoverController::class, 'getFormFiledByVoiceover'])->name('voiceoverFormField');

    });

    // Image
    Route::group(['prefix' => 'images', 'as' => 'image.', 'middleware' => 'userPermission:hide_image', 'controller' => V2ImageController::class], function() {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create')->middleware('teamAccess:image');
        Route::post('/', 'store')->name('store')->middleware('checkForDemoMode');
        Route::get('{image}', 'show')->name('show');
        Route::delete('{image}', 'destory')->name('destory');
        Route::post('favourite', 'toggleFavoriteImage')->name('favourite');
    });

    // Image To Video
    Route::group(['prefix' => 'image-to-video', 'as' => 'image-to-video.', 'middleware' => ['userPermission:hide_video', 'teamAccess:video'], 'controller' => \Modules\OpenAI\Http\Controllers\Customer\v2\ImageToVideoController::class], function() {
        Route::get('/', 'template')->name('videoTempalte');
        Route::post('/', 'store')->name('store')->middleware(['checkForDemoMode']);
        Route::get('get-video/{id}', 'getVideo')->name('getVideo');
    });
    
    // Text To Video
    Route::group(['prefix' => 'text-to-video', 'as' => 'text-to-video.', 'middleware' => ['userPermission:hide_text_to_video', 'teamAccess:video'],  'controller' => \Modules\OpenAI\Http\Controllers\Customer\v2\TextToVideoController::class], function() {
        Route::get('/', 'template')->name('template');
        Route::post('/', 'generate')->name('store')->middleware(['checkForDemoMode']);
        Route::get('get-video/{id}', 'getVideo')->name('getVideo');
    });

    // Gallery
    Route::group(['prefix' => 'gallery', 'as' => 'gallery.', 'middleware' => 'userPermission:hide_image', 'controller' => GalleryController::class], function() {
        Route::get('/', 'gallery')->name('show');
        Route::get('list', 'list')->name('list');
    });

    // Folder
    Route::get('/folder', [UserAIController::class, 'index'])->name('folderLists');

    // AI Detector
    Route::get('ai-detector', [AiDetectorController::class, 'template'])->name('aiDetectorTemplate')->middleware('teamAccess:ai_detector', 'userPermission:hide_ai_detector');

    // Plagiarism
    Route::get('plagiarism', [PlagiarismController::class, 'template'])->name('plagiarismTemplate')->middleware('teamAccess:plagiarism', 'userPermission:hide_plagiarism');

    // Code
    Route::middleware(['middleware' => 'userPermission:hide_code'])->group(function () {
        Route::get('code', [UserAIController::class, 'codeTemplate'])->name('codeTemplate')->middleware('teamAccess:code');
        Route::get('code-list', [CustomerCodeController::class, 'index'])->name('codeList');
        Route::get('code/view/{slug}', [CustomerCodeController::class, 'view'])->name('codeView');
        Route::post('code/delete/', [CustomerCodeController::class, 'delete'])->name('deleteCode');
    });

    // Speech To Text
    Route::middleware(['middleware' => 'userPermission:hide_speech_to_text'])->group(function () {
        Route::get('speech-to-text', [UserSpeechToTextController::class, 'template'])->name('speechTemplate')->middleware('teamAccess:speech_to_text');
        Route::get('speech-list', [UserSpeechToTextController::class, 'index'])->name('speechLists');
        Route::get('speech/edit/{id}', [UserSpeechToTextController::class, 'edit'])->name('editSpeech');
        Route::post('update-speech', [UserSpeechToTextController::class, 'update'])->name('updateSpeech');
        Route::post('delete-speech', [UserSpeechToTextController::class, 'delete'])->name('deleteSpeech');
    });

    // Folder
    Route::get('/folder', [FolderController::class, 'index'])->name('folderLists');
    Route::post('/folder-create', [FolderController::class, 'create'])->name('folderCreate');
    Route::post('/folder-update', [FolderController::class, 'update'])->name('folderUpdate');
    Route::get('/folder/{slug}', [FolderController::class, 'view'])->name('folderView');
    Route::get('/folder/download/{id}', [FolderController::class, 'download']);
    Route::post('/folder/download/content', [FolderController::class, 'downloadContent']);

    Route::get('/fetch-folder', [FolderController::class, 'fetchFolder'])->name('fetchFolder');
    Route::get('/fetch/all-folder', [FolderController::class, 'fetchAllFolder']);
    Route::post('/folder/move', [FolderController::class, 'moveData']);
    Route::post('/folder/delete', [FolderController::class, 'delete']);
    Route::post('/folder/toggle/bookmark', [FolderController::class, 'toggleBookmarkFiles']);

    Route::post('download/file', [UserAIController::class, 'downloadFile']);

    // Long Article
    Route::group(['prefix' => 'articles', 'as' => 'long_article.', 'controller' => LongArticleController::class, 'middleware' => 'userPermission:hide_long_article'], function () {
        // Crud routes
        Route::get('/', 'index')->name('index')->middleware('teamAccess:long_article');
        Route::get('create', 'create')->name('create')->middleware('teamAccess:long_article');
        Route::get('{id}/edit', 'edit')->name('edit');
        Route::patch('{id}', 'update')->name('update');
        Route::delete('{id}', 'destroy')->name('destroy');

        // Generator routes
        Route::post('generate-titles', 'generateTitles')->name('generate_titles')->middleware('teamAccess:long_article,api');
        Route::post('generate-outlines', 'generateOutlines')->name('generate_outlines')->middleware('teamAccess:long_article,api');
        Route::post('init-article', 'initArticle')->name('init_article')->middleware('teamAccess:long_article,api');
        Route::get('generate-article', 'generateArticle')->name('generate_article');

        // Display onload routes
        Route::post('display-title-data', 'displayTitleData')->name('display_title_data');
        Route::post('display-outline-data', 'displayOutlineData')->name('display_outline_data');
        Route::post('display-article-data', 'displayArticleBlogData')->name('display_article_data');
        Route::post('forget-session-data', 'forgetSessionData')->name('forget_session_data');
    });

    Route::group(['name' => 'template.', 'as' => 'template.', 'controller' => TemplateController::class, 'middleware' => 'teamAccess:template'], function () {
        Route::post('generate', 'generate')->name('generate');
        Route::get('process', 'process')->name('process');
    });

    Route::group(['name' => 'voiceClone.', 'prefix' => 'voice-clone','as' => 'voiceClone.', 'controller' => VoiceCloneController::class, 'middleware' => ['teamAccess:voice_clone', 'userPermission:hide_voice_clone']], function () {
        Route::get('/', 'template')->name('template');
        Route::get('/lists', 'index')->name('index');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::delete('delete', 'destroy')->name('delete');
    });

    // Ai Persona
    Route::group(['as' => 'ai-persona.', 'prefix' => 'ai-persona', 'controller' =>  \Modules\OpenAI\Http\Controllers\Customer\v2\AiPersonaController::class, 'middleware' => ['userPermission:hide_ai_persona']], function () {
        Route::get('/', 'template')->name('template')->middleware(['teamAccess:video']);
        Route::post('/store', 'store')->name('store')->middleware(['checkForDemoMode', 'teamAccess:video,api']);
    });

     // Ai Avatar
    Route::group(['as' => 'ai-avatar.', 'prefix' => 'ai-avatar', 'controller' =>  \Modules\OpenAI\Http\Controllers\Customer\v2\AiAvatarController::class, 'middleware' => ['userPermission:hide_ai_avatar']], function () {
        Route::get('/', 'template')->name('template')->middleware(['teamAccess:video']);
        Route::post('/store', 'store')->name('store')->middleware(['checkForDemoMode', 'teamAccess:video,api']);
    });

    Route::group(['as' => 'ai-product-photography.', 'prefix' => 'ai-product-photography', 'controller' =>  \Modules\OpenAI\Http\Controllers\Customer\v2\AiProductPhotographyController::class, 'middleware' => ['userPermission:hide_ai_product_photography']], function () {
        Route::get('/', 'template')->name('template')->middleware(['teamAccess:image']);
        Route::post('/store', 'store')->name('store')->middleware(['checkForDemoMode', 'teamAccess:image,api']);
    });

});

Route::middleware(['auth', 'locale', 'web'])->prefix('admin')->group(function () {
    Route::name('admin.use_case.')->group(function () {
        // use case
        Route::get('/use-cases', [UseCasesController::class, 'index'])->name('list');
        Route::match(['get', 'post'], '/use-case/create', [UseCasesController::class, 'create'])->name('create');
        Route::match(['get', 'post'], '/use-case/{id}/edit', [UseCasesController::class, 'edit'])->name('edit');
        Route::post('/use-case/{id}/delete', [UseCasesController::class, 'destroy'])->middleware(['checkForDemoMode'])->name('destroy');
        Route::get('use-case/pdf', [UseCasesController::class, 'pdf'])->middleware(['checkForDemoMode'])->name('pdf');
        Route::get('use-case/csv', [UseCasesController::class, 'csv'])->middleware(['checkForDemoMode'])->name('csv');

        // use case category
        Route::get('/use-case/categories', [UseCaseCategoriesController::class, 'index'])->name('category.list');
        Route::match(['get', 'post'], '/use-case/category/create', [UseCaseCategoriesController::class, 'create'])->name('category.create');
        Route::match(['get', 'post'], '/use-case/category/{id}/edit', [UseCaseCategoriesController::class, 'edit'])->name('category.edit');
        Route::post('/use-case/category/{id}/delete', [UseCaseCategoriesController::class, 'destroy'])->middleware(['checkForDemoMode'])->name('category.destroy');
        Route::get('/use-case/category/search', [UseCaseCategoriesController::class, 'searchCategory'])->name('category.search');
        Route::get('use-case-categories/pdf', [UseCaseCategoriesController::class, 'pdf'])->middleware(['checkForDemoMode'])->name('pdf');
        Route::get('use-case-categories/csv', [UseCaseCategoriesController::class, 'csv'])->middleware(['checkForDemoMode'])->name('csv');

    });

    Route::name('admin.chat.')->group(function () {

        // Chat category
        Route::get('/chat/categories', [ChatCategoriesController::class, 'index'])->name('category.list');
        Route::match(['get', 'post'], '/chat/category/create', [ChatCategoriesController::class, 'create'])->name('category.create');
        Route::match(['get', 'post'], '/chat/category/{id}/edit', [ChatCategoriesController::class, 'edit'])->name('category.edit');
        Route::post('/chat/category/{id}/delete', [ChatCategoriesController::class, 'destroy'])->middleware(['checkForDemoMode'])->name('category.destroy');
        Route::get('chat-categories/pdf', [ChatCategoriesController::class, 'pdf'])->middleware(['checkForDemoMode'])->name('category.pdf');
        Route::get('chat-categories/csv', [ChatCategoriesController::class, 'csv'])->middleware(['checkForDemoMode'])->name('category.csv');


        // Chat Assistants
        Route::get('/chat/assistants', [ChatAssistantsController::class, 'index'])->name('assistant.list');
        Route::match(['get', 'post'], '/chat/assistant/create', [ChatAssistantsController::class, 'create'])->name('assistant.create');
        Route::match(['get', 'post'], '/chat/assistant/{id}/edit', [ChatAssistantsController::class, 'edit'])->name('assistant.edit');
        Route::get('/chat/assistant/delete', [ChatAssistantsController::class, 'destroy'])->middleware(['checkForDemoMode'])->name('assistant.destroy');
        Route::get('chat-assistant/pdf', [ChatAssistantsController::class, 'pdf'])->middleware(['checkForDemoMode'])->name('assistant.pdf');
        Route::get('chat-assistant/csv', [ChatAssistantsController::class, 'csv'])->middleware(['checkForDemoMode'])->name('assistant.csv');

    });

    Route::name('admin.features.')->group(function () {
        // Content
        Route::get('content/list', [PrebuiltTemplateContentController::class, 'index'])->name('contents');
        Route::get('content/edit/{slug}', [PrebuiltTemplateContentController::class, 'edit'])->name('content.edit');
        Route::post('content/update/{id}', [PrebuiltTemplateContentController::class, 'update'])->middleware(['checkForDemoMode'])->name('content.update');
        Route::get('content/delete', [PrebuiltTemplateContentController::class, 'delete'])->middleware(['checkForDemoMode'])->name('content.delete');
        Route::get('content/pdf', [PrebuiltTemplateContentController::class, 'pdf'])->middleware(['checkForDemoMode'])->name('content.pdf');
        Route::get('content/csv', [PrebuiltTemplateContentController::class, 'csv'])->middleware(['checkForDemoMode'])->name('content.csv');

        // Import/Exports
        Route::get('/imports', [ImportController::class, 'index'])->name('voiceover.imports');
        Route::get('/imports/attributes', [ImportController::class, 'attributes'])->name('voiceover.attributes');
        Route::match(['GET', 'POST'], '/import/actors', [ImportController::class, 'actorImport'])->name('voiceover.import.actor');

        // Image
        Route::group(['prefix' => 'images', 'as' => 'admin.image.', 'controller' => AdminV2ImageController::class], function () {
            Route::get('csv', 'csv')->name('export_csv');
            Route::get('pdf', 'pdf')->name('print_pdf');
            Route::get('/', 'index')->name('index');
            Route::delete('{id}', 'destory')->name('destroy');
        });

        // Code
        Route::get('code/list', [CodeController::class, 'index'])->name('code.list');
        Route::get('code/view/{slug}', [CodeController::class, 'view'])->name('code.view');
        Route::post('code/delete', [CodeController::class, 'delete'])->middleware(['checkForDemoMode'])->name('code.delete');
        Route::get('code/pdf', [CodeController::class, 'pdf'])->middleware(['checkForDemoMode'])->name('code.pdf');
        Route::get('code/csv', [CodeController::class, 'csv'])->middleware(['checkForDemoMode'])->name('code.csv');

        // Content Preferences
        Route::get('features/preferences', [OpenAIController::class, 'contentPreferences'])->name('preferences');
        Route::post('features/preferences/create', [OpenAIController::class, 'createContentPreferences'])->middleware(['checkForDemoMode'])->name('preferences.create');

        // Manage Providers
        Route::match(['get', 'post'], 'providers/{feature}/{provider}', [ProviderManageController::class, 'manageProvider'])->name('provider_manage');
        Route::get('providers/{feature?}', [ProviderManageController::class, 'providers'])->name('providers');

        // Feature preference
        Route::get('features/{feature?}', [FeaturePreferenceController::class, 'manageFeature'])->name('feature_preference');
        Route::post('features/store', [FeaturePreferenceController::class, 'store'])->name('feature_preference.options');


        // Text To Speech
        Route::get('voiceovers', [AdminVoiceoverController::class, 'index'])->name('voiceover.lists');
        Route::get('voiceover/view/{id}', [AdminVoiceoverController::class, 'show'])->name('voiceover.view');
        Route::delete('voiceover/delete/{id}', [AdminVoiceoverController::class, 'delete'])->middleware(['checkForDemoMode'])->name('voiceover.delete');
        Route::get('voiceover/pdf', [AdminVoiceoverController::class, 'pdf'])->middleware(['checkForDemoMode'])->name('voiceover.pdf');
        Route::get('voiceover/csv', [AdminVoiceoverController::class, 'csv'])->middleware(['checkForDemoMode'])->name('voiceover.csv');

        // All Voices
        Route::get('voiceover/voice/list', [AdminVoiceoverController::class, 'allVoices'])->name('voiceover.voice.lists');
        Route::get('voice/pdf', [AdminVoiceoverController::class, 'voicePdf'])->middleware(['checkForDemoMode'])->name('voiceover.voice.pdf');
        Route::get('voice/csv', [AdminVoiceoverController::class, 'voiceCsv'])->middleware(['checkForDemoMode'])->name('voiceover.voice.csv');
        Route::match(['get', 'post'], 'voiceover/voice/edit/{id}', [AdminVoiceoverController::class, 'voiceEdit'])->name('voiceover.voice.edit');

        // Speech
        Route::get('speech/list', [SpeechToTextController::class, 'index'])->name('speeches');
        Route::get('speech/edit/{id}', [SpeechToTextController::class, 'edit'])->name('speech.edit');
        Route::post('speech/update/{id}', [SpeechToTextController::class, 'update'])->middleware(['checkForDemoMode'])->name('speech.update');
        Route::post('speech/delete', [SpeechToTextController::class, 'delete'])->middleware(['checkForDemoMode'])->name('speech.delete');
        Route::get('speech/pdf', [SpeechToTextController::class, 'pdf'])->middleware(['checkForDemoMode'])->name('speech.pdf');
        Route::get('speech/csv', [SpeechToTextController::class, 'csv'])->middleware(['checkForDemoMode'])->name('speech.csv');

        // Ai Chatbot's
        Route::group(['prefix' => 'ai-chatbot', 'as' => 'ai_chatbot.', 'controller' => AiChatbotController::class], function() {
            Route::get('/', 'index')->name('index');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->middleware(['checkForDemoMode'])->name('update');
            Route::delete('delete/{id}', 'destroy')->middleware(['checkForDemoMode'])->name('delete');
            Route::get('pdf', 'pdf')->middleware(['checkForDemoMode'])->name('pdf');
            Route::get('csv', 'csv')->middleware(['checkForDemoMode'])->name('csv');
        });

        Route::group(['prefix' => 'image-to-video', 'as' => 'image-to-video.', 'controller' => \Modules\OpenAI\Http\Controllers\Admin\v2\ImageToVideoController::class], function() {
            Route::get('/', 'index')->name('index');
            Route::delete('/delete/{id}', 'destroy')->middleware(['checkForDemoMode'])->name('delete');
        });

        Route::group(['prefix' => 'text-to-video', 'as' => 'text-to-video.', 'controller' => \Modules\OpenAI\Http\Controllers\Admin\v2\TextToVideoController::class], function() {
            Route::get('/', 'index')->name('index');
            Route::delete('/delete/{id}', 'destroy')->middleware(['checkForDemoMode'])->name('delete');
        });

        // Avatars
        Route::group(['prefix' => 'ai-character', 'as' => 'ai-character.', 'controller' => \Modules\OpenAI\Http\Controllers\Admin\v2\AiCharacterController::class], function() {
            Route::get('/avatars', 'avatars')->name('avatars');
            Route::get('/avatar-voices', 'voices')->name('voices');
            Route::post('/sync', 'sync')->name('sync');

        });

        Route::group(['prefix' => 'ai-persona', 'as' => 'ai-persona.', 'controller' => \Modules\OpenAI\Http\Controllers\Admin\v2\AiPersonaController::class], function() {
            Route::get('/', 'index')->name('index');
            Route::delete('/delete/{id}', 'destroy')->middleware(['checkForDemoMode'])->name('delete');
        });

        Route::group(['prefix' => 'ai-avatar', 'as' => 'ai-avatar.', 'controller' => \Modules\OpenAI\Http\Controllers\Admin\v2\AiAvatarController::class], function() {
            Route::get('/', 'index')->name('index');
            Route::delete('/delete/{id}', 'destroy')->middleware(['checkForDemoMode'])->name('delete');
        });   
        Route::group(['prefix' => 'product-backgrounds', 'as' => 'product-backgrounds.', 'controller' => \Modules\OpenAI\Http\Controllers\Admin\v2\ProductBackgroundController::class], function() {
            Route::get('/', 'index')->name('index');
            Route::post('/sync', 'sync')->name('sync');
        });

        Route::group(['prefix' => 'ai-product-photography', 'as' => 'ai-product-photography.', 'controller' => \Modules\OpenAI\Http\Controllers\Admin\v2\AiProductPhotographyController::class], function() {
            Route::get('/', 'index')->name('index');
            Route::delete('{id}', 'destory')->middleware(['checkForDemoMode'])->name('destroy');
            Route::get('csv', 'csv')->name('export_csv');
            Route::get('pdf', 'pdf')->name('print_pdf');
        });

    });

    // Long Article
    Route::group(['prefix' => 'articles', 'as' => 'admin.long_article.', 'controller' => AdminLongArticleController::class], function () {
        Route::get('csv', 'csv')->name('export_csv');
        Route::get('pdf', 'pdf')->name('print_pdf');
        Route::get('/', 'index')->name('index');
        Route::get('{id}', 'edit')->name('edit');
        Route::post('{id}', 'update')->name('update');
        Route::delete('{id}', 'destory')->name('destroy');
    });
});

Route::middleware(['auth', 'locale', 'web'])->prefix('user/openai')->name('user.')->group(function () {
    Route::get('/use-case/search', [CustomerUseCasesController::class, 'searchTabData'])->name('use_case.search');
    Route::post('/use-case/toggle/favorite', [CustomerUseCasesController::class, 'toggleFavorite'])->name('use_case.toggle.favorite');
    Route::get('/documents/fetch', [CustomerDocumentsController::class, 'fetchAndFilter'])->name('document.fetch');
    Route::post('/documents/toggle/bookmark', [CustomerDocumentsController::class, 'toggleBookmark'])->name('document.toggle.bookmark');
});


# API Routes

Route::group(['prefix' => 'api', 'middleware' => ['api']], function () {

    // Version 2 Routes
    Route::group(['as' => 'api.', 'prefix' => '/v2', 'middleware' => ['auth:api', 'locale', 'permission-api']], function () {
        
        // Chat Bot
        Route::group(['as' => 'chatbot.', 'prefix' => 'chat/bots', 'controller' => ChatBotController::class], function() {
            Route::get('/', 'index')->name('index');
            Route::get('{chatbot}', 'show')->name('show');
        });

        // Chat Widget Bot
        Route::group(['as' => 'chatbotwidget.', 'prefix' => 'widget/chatbots', 'controller' => ChatBotWidgetController::class, 'middleware' => ['teamAccess:chatbot,api', 'userPermission:hide_aichatbot']], function() {
            Route::get('/', 'index')->name('index');
            Route::post('/create', 'store')->name('store')->middleware(['checkForDemoMode']);
            Route::get('{chatbot}', 'show')->name('show');
            Route::patch('/update/{chatbot}', 'update')->name('update')->middleware(['checkForDemoMode']);
            Route::delete('{chatbot}', 'delete')->name('delete')->middleware(['checkForDemoMode']);

            Route::delete('delete-image/{chatbot}', 'destroyImage')->name('destroyImage');

            // Widget Chatbot's Dashboard
            Route::get('/dashboard/material', 'dashboard')->name('dashboard');
        });

        // Train Chatbot Materials
        Route::group([
            'as' => 'chatbotwidget.training.',
            'prefix' => 'widget/chatbot/materials', 'controller' => ChatBotTrainingController::class,
            'middleware' => ['teamAccess:chatbot,api', 'userPermission:hide_aichatbot']
        ], function() {

            Route::get('/{chatbot}', 'index')->name('index');
            Route::post('/store/{chatbot}', 'store')->name('store')->middleware(['checkForDemoMode']);
            Route::post('/train/{chatbot}', 'train')->name('train')->middleware(['checkForDemoMode']);
            Route::delete('/destroy', 'destroy')->name('destroy')->middleware(['checkForDemoMode']);
            Route::post('/fetch-url', 'fetchUrl')->name('fetchUrl')->middleware(['checkForDemoMode']);
            Route::get('/{chatbot}/download/csv', 'csv')->name('download.csv');

        });

         // Widget chatbot's User Conversation
         Route::group(['as' => 'chatbots.', 'prefix' => '/user/chatbots', 'controller' => \Modules\OpenAI\Http\Controllers\Api\v2\User\ChatBotUserConversationController::class, 'middleware' => ['teamAccess:chatbot,api', 'userPermission:hide_aichatbot']], function () {
            Route::get('chats', 'index')->name('index');
            Route::get('chats/{conversation_id}', 'show')->name('show');
            Route::delete('chats/{id}', 'delete')->name('delete')->middleware(['checkForDemoMode']);
        });

         // User Conversation test

         Route::group(['as' => 'chatbots.', 'prefix' => '/test/user/chatbots', 'controller' => \Modules\OpenAI\Http\Controllers\Api\v2\User\ChatBotUserTestConversationController::class,'middleware' => ['teamAccess:chatbot,api', 'userPermission:hide_aichatbot']], function () {
            Route::post('chats', 'store')->name('store')->middleware(['checkForDemoMode']);
            Route::get('chats/{conversation_id}', 'show')->name('show');
        });
        
        // Chat
        Route::group(['as' => 'chat.', 'prefix' => 'chats', 'controller' => \Modules\OpenAI\Http\Controllers\Api\v2\User\AiChatController::class], function () {
            Route::get('{chat}', 'show')->name('show');
            Route::post('/', 'store')->name('store')->middleware('userPermission:hide_chat', 'teamAccess:chat,api');
        });

        // Doc Chat
        Route::group(['as' => 'embed.','prefix' => 'embed-resources', 'controller' => AiDocChatController::class, 'middleware' => ['teamAccess:chat,api', 'userPermission:hide_chat']], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::delete('{id}', 'delete')->name('delete');
        });

        Route::group(['as' => 'embed.', 'controller' => \Modules\OpenAI\Http\Controllers\Api\v2\User\DocChatAskController::class, 'middleware' => ['teamAccess:chat,api', 'userPermission:hide_chat']], function () {
            Route::post('resources/ask', 'askQuestion')->name('question');
        });

        // User Access
        Route::group(['as' => 'userAccess.', 'controller' => UserAccessControllerAPI::class], function () {
            Route::get('user-access', 'index')->name('index');
        });
        
        Route::group(['as' => 'docChat.', 'controller' => DocChatControllerAPI::class], function () {
            Route::get('conversation/{id}', 'conversation')->name('view');
        });

        // Vision
        Route::group(['as' => 'vision.', 'prefix' => 'vision', 'controller' => VisionController::class], function() {
            Route::post('/', 'store')->name('store')->middleware('userPermission:hide_chat', 'teamAccess:chat,api');
        });

        // Code
        Route::group(['as' => 'code.', 'prefix' => 'code', 'controller' => \Modules\OpenAI\Http\Controllers\Api\v2\User\CodeController::class, 'middleware' => 'teamAccess:code'], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('{id}', 'show')->name('show');
            Route::delete('{id}', 'delete')->name('delete');
        });

        Route::group(['as' => 'template.', 'prefix' => 'template', 'controller' => TemplateController::class, 'middleware' => 'teamAccess:template'], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'generate')->name('store');
            Route::get('/process', 'process')->name('process');
            Route::post('/edit/{id}', 'update')->name('update');
            Route::get('{id}', 'show')->name('show');
            Route::delete('{id}', 'delete')->name('delete');
            Route::post('toggle/bookmark', 'toggleFavorite')->name('toggleFavorite');
        });

        // Feature manager provider
        Route::group(['as' => 'featureManager.', 'prefix' => 'provider', 'controller' => FeatureManagerController::class], function () {
            Route::get('{feature}', 'providers')->name('providers');
            Route::get('{feature}/{provider}', 'models')->name('models');
            Route::get('{feature}/{provider}/preference', 'preference')->name('preference');
            Route::get('{feature}/{provider}/{model}', 'addiontalOptions');
        });

        // Voiceover
        Route::group(['as' => 'voiceover.', 'prefix' => 'voiceover', 'controller' => VoiceoverControllerAPI::class], function () {
            Route::get('voices/{provider}', [VoiceoverControllerAPI::class, 'voices']);

            Route::get('/', [VoiceoverControllerAPI::class, 'index']);
            Route::post('/', [VoiceoverControllerAPI::class, 'generate'])->middleware(['checkForDemoMode','userPermission:hide_text_to_speech', 'teamAccess:voiceover,api']);
            Route::get('{id}', [VoiceoverControllerAPI::class, 'show']);
            Route::delete('{id}', [VoiceoverControllerAPI::class, 'destroy'])->middleware(['checkForDemoMode']);
        });

        Route::group(['as' => 'featurePreference.', 'controller' => FeaturePreferenceAPI::class], function () {
            Route::get('/feature-preferences', 'featureOptions');
        });

        // Speech To Text
        Route::group(['as' => 'speech.', 'prefix' => 'speeches', 'controller' => \Modules\OpenAI\Http\Controllers\Api\v2\User\SpeechToTextController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'generate')->name('speechToText')->middleware(['checkForDemoMode', 'userPermission:hide_speech_to_text', 'teamAccess:speech_to_text,api']);
            Route::get('{id}', 'show')->name('show');
            Route::patch('update/{id}', 'update')->name('update')->middleware(['checkForDemoMode']);
            Route::delete('{id}', 'delete')->name('delete')->middleware(['checkForDemoMode']);
        });    
        // Image
        Route::group(['as' => 'image.', 'prefix' => 'images', 'controller' => \Modules\OpenAI\Http\Controllers\Api\v2\User\ImageController::class, 'middleware' => 'teamAccess:image,api'], function () {
            Route::post('/', 'store')->name('store')->middleware(['checkForDemoMode']);
            Route::get('gallery', 'index')->name('index');
            Route::delete('{image}', 'destroy')->name('destroy');
            Route::post('toggle/favorite', 'toggleFavorite')->name('toggleFavorite');
        });
        
        // History
        Route::group(['as' => 'history.', 'prefix' => 'ai-chat', 'controller' => \Modules\OpenAI\Http\Controllers\Api\v2\User\HistoryController::class,'middleware' => 'teamAccess:chat,api'], function () {
            Route::get('history', 'index')->name('index');
            Route::get('history/{history_id}', 'show')->name('show');
            Route::delete('history/{history_id}', 'destroy')->name('destroy');
        });

        // Plagiarism
        Route::group(['as' => 'plagiarism.', 'prefix' => 'plagiarism', 'controller' => \Modules\OpenAI\Http\Controllers\Api\v2\User\PlagiarismController::class, 'middleware' => 'teamAccess:plagiarism,api'], function () {
            Route::post('/', 'generate')->name('generate');
        });

        // Ai Detector
        Route::group(['as' => 'aidetector.', 'prefix' => 'aidetector', 'controller' => \Modules\OpenAI\Http\Controllers\Api\v2\User\AiDetectorController::class, 'middleware' => 'teamAccess:ai_detector,api'], function () {
            Route::post('/', 'generate')->name('generate');
        });

        // Voice Clone
        Route::group(['as' => 'voiceClone.', 'name' => 'voiceClone.' , 'prefix' => 'voice-clone', 'controller' => \Modules\OpenAI\Http\Controllers\Api\v2\User\VoiceCloneController::class, 'middleware' => ['teamAccess:voice_clone,api', 'userPermission:hide_voice_clone']], function () {
            Route::post('/generate', 'generate')->name('generate')->middleware(['checkForDemoMode']);
        });

        // Use Case
        Route::group(['as' => 'use.case.', 'prefix' => 'use-cases', 'controller' => \Modules\OpenAI\Http\Controllers\Api\v2\User\UseCaseController::class], function () {
            Route::get('/', 'index')->name('index');
        });

        // Text To Video
        Route::group(['as' => 'text-to-video.', 'prefix' => 'text-to-video', 'middleware' => ['teamAccess:video,api', 'userPermission:hide_text_to_video'], 'controller' => \Modules\OpenAI\Http\Controllers\Api\v2\User\TextToVideoController::class], function () {
            Route::post('/', 'generate')->name('store')->middleware(['checkForDemoMode']);
            Route::get('get-video/{id}', 'getVideo')->name('getVideo');
        });

        // Image To Video
        Route::group(['as' => 'aiVideo.', 'prefix' => 'image-to-video', 'controller' => ImageToVideoControllerAPI::class, 'middleware' => ['teamAccess:video,api', 'userPermission:hide_video']], function () {
            Route::post('/', 'store')->name('store')->middleware(['checkForDemoMode']);
            Route::get('get-video/{id}', 'getVideo')->name('getVideo');
        });

        // Video
        Route::group(['as' => 'video.', 'prefix' => 'video', 'controller' => \Modules\OpenAI\Http\Controllers\Api\v2\User\VideoController::class, 'middleware' => ['teamAccess:video,api']], function () {
            Route::get('/', 'index')->name('index');
            Route::get('{id}', 'show')->name('show');
            Route::delete('{id}', 'destroy')->name('destroy')->middleware(['checkForDemoMode']);
        });

        // Sidebar
        Route::get('user/sidebar', [\Modules\OpenAI\Http\Controllers\Api\v2\User\UserController::class, 'sidebar'])->name('sidebar');

    });

    // Version 3 Routes
    Route::group(['as' => 'api.', 'prefix' => '/v3', 'middleware' => ['auth:api', 'locale', 'permission-api']], function () {

         // Feature manager provider
         Route::group(['as' => 'feature.manager.v3.', 'prefix' => 'provider',  'controller' => V3FeatureManagerController::class], function () {
            Route::get('{feature}', 'providers')->name('providers');
        });
    });

    Route::group(['prefix' => '/V1/user/openai', 'middleware' => ['auth:api', 'locale', 'permission-api']], function () {
        // use case
        Route::post('/use-case/toggle/favorite', [UseCasesControllerAPI::class, 'useCaseToggleFavorite']);

        // use case category
        Route::get('/use-case/categories', [UseCaseCategoriesControllerAPI::class, 'index']);

        //Update Profile
        Route::post('/profile', [UserControllerAPI::class, 'update']);
        Route::post('/profile/delete', [UserControllerAPI::class, 'destroy']);

        //Subscription Package Info
        Route::get('/package-info', [UserControllerAPI::class, 'index']);

    });
});

# API Visitor ChatBot Conversations Routes

Route::group(['prefix' => 'api', 'middleware' => ['api']], function () {
    Route::group(['prefix' => '/v2', 'middleware' => ['locale']], function () {
        Route::group(['as' => 'chatbots.', 'prefix' => '/chatbots/chats', 'controller' => \Modules\OpenAI\Http\Controllers\Api\v2\User\ChatBotConversationController::class], function () {
            Route::get('{id}', 'index')->name('index');
            Route::post('create', 'store')->name('store')->middleware(['checkForDemoMode']);
            Route::get('{visitor_id}/{id}', 'show')->name('show');
            Route::delete('{visitor_id}/{id}', 'destroy')->name('destroy')->middleware(['checkForDemoMode']);
        });

        Route::group(['prefix' => 'visitor/widget/chatbots', 'controller' => ChatBotWidgetController::class], function() {
            Route::get('details/{chatbot}', 'details');
        });
    });
});
