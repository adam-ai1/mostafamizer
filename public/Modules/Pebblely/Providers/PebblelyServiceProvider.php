<?php

namespace Modules\Pebblely\Providers;

use AiProviderManager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class PebblelyServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        AiProviderManager::add(\Modules\Pebblely\PebblelyProvider::class, 'pebblely');

        \Config::set('aiKeys.PEBBLELY.API_KEY', env('PEBBLELY', false));

        add_action('before_provider_api_key_section_retrived', function() {
            echo '<div class="form-group row">
                    <label class="col-sm-3 control-label text-left">' . __(":x API Key", ["x" => "Pebblely"]) . '</label>
                    <div class="col-sm-8">
                        <input type="text"
                            value="' . (config("openAI.is_demo") ? "sk-xxxxxxxxxxxxxxx" : config("aiKeys.PEBBLELY.API_KEY")) . '"
                            class="form-control inputFieldDesign" name="apiKey[pebblely]" id="pebblely_key">
                    </div>
                </div>';
        });
    }
}
