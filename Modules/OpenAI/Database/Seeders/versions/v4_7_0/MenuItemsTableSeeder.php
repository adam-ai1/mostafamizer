<?php

namespace Modules\OpenAI\Database\Seeders\versions\v4_7_0;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        
        DB::table('menu_items')->where('link', 'text-to-speech/list')->update([
            'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\VoiceoverController@index","route_name":["admin.features.voiceover.lists", "admin.features.voiceover.view"]}',
            'link' => 'voiceovers'
        ]);

        DB::table('admin_menus')->where('slug', 'voiceover')->update([
            'url' => 'voiceovers',
            'permission' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\VoiceoverController@index","route_name":["admin.features.voiceover.lists", "admin.features.voiceover.view"],"menu_level":"1"}',
        ]);

        DB::table('menu_items')->where('link', 'text-to-speech/voice/list')->update([
            'link' => 'voiceover/voice/list',
            'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\VoiceoverController@allVoices","route_name":["admin.features.voiceover.voice.lists", "admin.features.voiceover.voice.edit"]}',
        ]);
    }
}
