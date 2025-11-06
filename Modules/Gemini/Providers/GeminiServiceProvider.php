<?php

namespace Modules\Gemini\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\AiProviderManager;

class GeminiServiceProvider extends ServiceProvider
{
   /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        AiProviderManager::add(\Modules\Gemini\GeminiProvider::class, 'gemini');

        \Config::set('aiKeys.GEMINI.API_KEY', env('GEMINI', false));

        add_action('before_provider_api_key_section_retrived', function() {

            echo '<div class="form-group row">
                    <label class="col-sm-3 control-label text-left">' . __(":x API Key", ["x" => "Gemini"]) . '</label>
                    <div class="col-sm-8">
                        <input type="text"
                            value="' . (config("openAI.is_demo") ? "sk-xxxxxxxxxxxxxxx" : config("aiKeys.GEMINI.API_KEY")) . '"
                            class="form-control inputFieldDesign" name="apiKey[gemini]" id="gemini_key">
                    </div>
                </div>';
        });

        add_filter('modify_voiceover_data', function($data) {
            return array_merge($data, [
                'gemini' => [
                    'model' => [
                        "gemini-2.5-flash-preview-tts" => "Gemini 2.5 Flash Preview TTS",
                        "gemini-2.5-pro-preview-tts" => "Gemini 2.5 Pro Preview TTS",
                    ],
                ]
            ]);
        });
    }
}
