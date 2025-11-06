<?php

namespace Modules\Meta\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\AiProviderManager;
use Config;

class MetaServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        AiProviderManager::add(\Modules\Meta\MetaProvider::class, 'meta');

        Config::set('aiKeys.META.API_KEY', env('META', false));

        add_action('before_provider_api_key_section_retrived', function() {

            echo '<div class="form-group row">
                    <label class="col-sm-3 control-label text-left">' . __(":x API Key", ["x" => "Meta"]) . '</label>
                    <div class="col-sm-8">
                        <input type="text"
                            value="' . (config("openAI.is_demo") ? "sk-xxxxxxxxxxxxxxx" : config("aiKeys.META.API_KEY")) . '"
                            class="form-control inputFieldDesign" name="apiKey[meta]" id="meta_key">
                    </div>
                </div>';
        });
    }
}