<?php

namespace Modules\HeyGen\Providers;

use Illuminate\Support\ServiceProvider;
use AiProviderManager;

class HeyGenServiceProvider extends ServiceProvider
{
     /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        AiProviderManager::add(\Modules\HeyGen\HeyGenProvider::class, 'heygen');

        \Config::set('aiKeys.HEYGEN.API_KEY', env('HEYGEN', false));

        add_action('before_provider_api_key_section_retrived', function() {
            echo '<div class="form-group row">
                    <label class="col-sm-3 control-label text-left">' . __(":x API Key", ["x" => "HeyGen"]) . '</label>
                    <div class="col-sm-8">
                        <input type="text"
                            value="' . (config("openAI.is_demo") ? "sk-xxxxxxxxxxxxxxx" : config("aiKeys.HEYGEN.API_KEY")) . '"
                            class="form-control inputFieldDesign" name="apiKey[heygen]" id="heygen_key">
                    </div>
                </div>';
        });
    }
}
