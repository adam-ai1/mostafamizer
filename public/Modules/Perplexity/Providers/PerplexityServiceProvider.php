<?php

namespace Modules\Perplexity\Providers;

use Illuminate\Support\ServiceProvider;
use AiProviderManager;

class PerplexityServiceProvider extends ServiceProvider
{
     /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        AiProviderManager::add(\Modules\Perplexity\PerplexityProvider::class, 'perplexity');

        \Config::set('aiKeys.PERPLEXITY.API_KEY', env('PERPLEXITY', false));

        add_action('before_provider_api_key_section_retrived', function() {
            echo '<div class="form-group row">
                    <label class="col-sm-3 control-label text-left">' . __(":x API Key", ["x" => "Perplexity"]) . '</label>
                    <div class="col-sm-8">
                        <input type="text"
                            value="' . (config("openAI.is_demo") ? "sk-xxxxxxxxxxxxxxx" : config("aiKeys.PERPLEXITY.API_KEY")) . '"
                            class="form-control inputFieldDesign" name="apiKey[perplexity]" id="perplexity_key">
                    </div>
                </div>';
        });
    }
}
