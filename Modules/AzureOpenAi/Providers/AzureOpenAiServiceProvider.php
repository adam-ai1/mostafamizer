<?php

namespace Modules\AzureOpenAi\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\AiProviderManager;

class AzureOpenAiServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        AiProviderManager::add(\Modules\AzureOpenAi\AzureOpenAiProvider::class, 'azureopenai');
        
        \Config::set('aiKeys.AZUREOPENAI.API_KEY', env('AZUREOPENAI', false));
        \Config::set('aiKeys.AZUREOPENAI.ENDPOINT', env('AZUREOPENAI_URL', false));

        add_action('before_provider_api_key_section_retrived', function() {

            echo '<div class="form-group row">
                    <label class="col-sm-3 control-label text-left">' . __(":x API Key", ["x" => "Azure OpenAI"]) . '</label>
                    <div class="col-sm-8">
                        <input type="text"
                            value="' . (config("openAI.is_demo") ? "sk-xxxxxxxxxxxxxxx" : config("aiKeys.AZUREOPENAI.API_KEY")) . '"
                            class="form-control inputFieldDesign" name="apiKey[azureopenai]" id="azureopenai_key">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-3 control-label text-left">' . __(":x Endpoint", ["x" => "Azure OpenAI"]) . '</label>
                    <div class="col-sm-8">
                        <input type="text"
                            value="' . (config("openAI.is_demo") ? "sk-xxxxxxxxxxxxxxx" : config("aiKeys.AZUREOPENAI.ENDPOINT")) . '"
                            class="form-control inputFieldDesign" name="apiKey[azureopenai_url]" id="azureopenai_url">
                    </div>
                </div>';
        });

        add_filter('modify_voiceover_data', function($data) {
            return array_merge($data, [
                'azureopenai' => [
                    'model' => [
                        'tts-1' => 'TTS',
                        'tts-1-hd' => 'TTS HD',
                        'gpt-4o-mini-tts' => 'GPT-4o Mini TTS'
                    ],
                ]
            ]);
        });
    }
}
