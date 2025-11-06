<?php

namespace Modules\OpenAI\Database\Seeders\versions\v4_9_0;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        
        $parentId = DB::table('menu_items')->where('link', 'voiceover/voice/list')->value('parent');

        $menuItemId = DB::table('menu_items')->where('id', $parentId)->update(['label' => 'AI Characters', 'icon' => 'fas fa-users']);

        DB::table('menu_items')->updateOrInsert(
            ['link' => 'ai-character/avatars'],
            [
                'label' => 'Avatars',
                'link' => 'ai-character/avatars',
                'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\v2\\\\AiCharacterController@avatars","route_name":["admin.features.ai-character.avatars"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => $parentId,
                'sort' => 3,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
                'is_custom_menu' => 0
            ]
        );

        DB::table('menu_items')->updateOrInsert(
            ['link' => 'ai-character/avatar-voices'],
            [
                'label' => 'Avatar Voices',
                'link' => 'ai-character/avatar-voices',
                'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\v2\\\\AiCharacterController@voices","route_name":["admin.features.ai-character.voices"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => $parentId,
                'sort' => 3,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
                'is_custom_menu' => 0
            ]
        );

        DB::table('menu_items')->updateOrInsert(
        [
            'label' => 'Ai Persona',
            'link' => 'ai-persona',
            'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\v2\\\\AiPersonaController@index","route_name":["admin.features.ai-persona.index"]}',
            'is_default' => 1,
            'icon' => NULL,
            'parent' => 143,
            'sort' => 12,
            'class' => NULL,
            'menu' => 1,
            'depth' => 1,
            'is_custom_menu' => 0
        ],['link' => 'ai-persona']);
    }
}
