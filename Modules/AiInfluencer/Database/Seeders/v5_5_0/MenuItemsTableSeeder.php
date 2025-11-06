<?php

namespace Modules\AiInfluencer\Database\Seeders\v5_5_0;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        
        if (DB::table('menu_items')->where('link', 'ai-influencer')->exists()) {
            return ;
        }

        $menuData = [
            'label' => 'Ai Influencer',
            'link' => 'ai-influencer',
            'params' => '{"permission":"Modules\\\\AiInfluencer\\\\Http\\\\Controllers\\\\Admin\\\\AiInfluencerController@index","route_name":["admin.features.ai-influencer.index"]}',
            'is_default' => 1,
            'icon' => NULL,
            'parent' => 143,
            'sort' => 20,
            'class' => NULL,
            'menu' => 1,
            'depth' => 1,
            'is_custom_menu' => 0
        ];

        DB::table('menu_items')->insert($menuData);
    }
}
