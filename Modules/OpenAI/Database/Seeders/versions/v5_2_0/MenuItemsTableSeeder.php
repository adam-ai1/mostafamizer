<?php

namespace Modules\OpenAI\Database\Seeders\versions\v5_2_0;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        
        DB::table('menu_items')->updateOrInsert(
            [
                'label' => 'Ai Avatar',
                'link' => 'ai-avatar',
                'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\v2\\\\AiAvatarController@index","route_name":["admin.features.ai-avatar.index"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 143,
                'sort' => 22,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
                'is_custom_menu' => 0
            ],['link' => 'ai-avatar']);

        $parentId = DB::table('menu_items')->where('link', 'voiceover/voice/list')->value('parent');

        $menuItemId = DB::table('menu_items')->where('id', $parentId)->first()->id;

        DB::table('menu_items')->updateOrInsert(
        [
            'label' => 'Product Backgrounds',
            'link' => 'product-backgrounds',
            'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\v2\\\\ProductBackgroundController@index","route_name":["admin.features.product-backgrounds.index"]}',
            'is_default' => 1,
            'icon' => NULL,
            'parent' => $menuItemId,
            'sort' => 12,
            'class' => NULL,
            'menu' => 1,
            'depth' => 1,
            'is_custom_menu' => 0
        ],['link' => 'product-backgrounds']);

        DB::table('menu_items')->updateOrInsert(
        [
            'label' => 'Ai Product Photography',
            'link' => 'ai-product-photography',
            'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\v2\\\\AiProductShotController@index","route_name":["admin.features.ai-product-photography.index"]}',
            'is_default' => 1,
            'icon' => NULL,
            'parent' => 143,
            'sort' => 15,
            'class' => NULL,
            'menu' => 1,
            'depth' => 1,
            'is_custom_menu' => 0
        ],['link' => 'ai-product-photography']);
    }
}
