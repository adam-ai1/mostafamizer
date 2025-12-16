<?php

namespace Modules\Grok\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\AiProviderManager;
use Config;

class GrokServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        AiProviderManager::add(\Modules\Grok\GrokProvider::class, 'grok');

        Config::set('aiKeys.GROK.API_KEY', env('GROK', false));

        add_action('before_provider_api_key_section_retrived', function() {

            echo '<div class="form-group row">
                    <label class="col-sm-3 control-label text-left">' . __(":x API Key", ["x" => "Grok"]) . '</label>
                    <div class="col-sm-8">
                        <input type="text"
                            value="' . (config("openAI.is_demo") ? "sk-xxxxxxxxxxxxxxx" : config("aiKeys.GROK.API_KEY")) . '"
                            class="form-control inputFieldDesign" name="apiKey[grok]" id="grok_key">
                    </div>
                </div>';
        });
    }
}
