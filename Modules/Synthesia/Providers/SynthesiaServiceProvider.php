<?php

namespace Modules\Synthesia\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use AiProviderManager;

class SynthesiaServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        AiProviderManager::add(\Modules\Synthesia\SynthesiaProvider::class, 'synthesia');

        \Config::set('aiKeys.SYNTHESIA.API_KEY', env('SYNTHESIA', false));

        add_action('before_provider_api_key_section_retrived', function() {
            echo '<div class="form-group row">
                    <label class="col-sm-3 control-label text-left">' . __(":x API Key", ["x" => "Synthesia"]) . '</label>
                    <div class="col-sm-8">
                        <input type="text"
                            value="' . (config("openAI.is_demo") ? "sk-xxxxxxxxxxxxxxx" : config("aiKeys.SYNTHESIA.API_KEY")) . '"
                            class="form-control inputFieldDesign" name="apiKey[synthesia]" id="synthesia_key">
                    </div>
                </div>';
        });
    }
}
