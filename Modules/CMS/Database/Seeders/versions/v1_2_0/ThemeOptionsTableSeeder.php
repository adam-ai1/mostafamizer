<?php

namespace Modules\CMS\Database\Seeders\versions\v1_2_0;

use Illuminate\Database\Seeder;
use Modules\CMS\Http\Models\ThemeOption;

class ThemeOptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $theme = ThemeOption::where('name', 'default_template_footer')->first();
        $array = json_decode($theme->value, true);
        isset($array['main']['resource_links']['data'][3]['link']) ? $array['main']['resource_links']['data'][3]['link'] = 'https:\/\/stablediffusionapi.com\/docs\/' : '';
        isset($array['main']['support_links']['data'][2]['link']) ? $array['main']['support_links']['data'][2]['link'] = 'https:\/\/stablediffusionapi.com\/docs\/' : '';
        $newJson = json_encode($array, JSON_PRETTY_PRINT);
        $data = [
            'id' => $theme->id,
            'name' => 'default_template_footer',
            'value' => $newJson,
        ];

        $replaceFrom = [
            moduleConfig('cms.replace_url_one'),
            moduleConfig('cms.replace_url_two')
        ];

        $replaceTo = url('/');
        
        $data['value'] = str_replace($replaceFrom, $replaceTo, $data['value']);

        \DB::table('theme_options')->upsert($data, 'name');

    }
}
