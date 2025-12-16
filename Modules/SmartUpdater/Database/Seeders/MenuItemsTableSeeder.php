<?php

namespace Modules\SmartUpdater\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsTableSeeder extends Seeder
{
    public function run()
    {
        $addonMenu = DB::table('menu_items')->where('label', 'Addon Manager')->first();
        
        $parent = $addonMenu->parent ?? 0;
        $sort = $addonMenu ? ($addonMenu->sort + 1) : 59;

        DB::table('menu_items')->updateOrInsert(
            ['link' => 'smart-updater'],
            [
                'label' => 'Smart Updater',
                'link' => 'smart-updater',
                'params' => '{"permission":"Modules\\\\SmartUpdater\\\\Http\\\\Controllers\\\\SmartUpdaterController@index", "route_name":["smart-updater.index", "smart-updater.analyze", "smart-updater.install", "smart-updater.backups", "smart-updater.restore", "smart-updater.delete-backup"], "menu_level":"1"}', 
                'is_default' => 1,
                'icon' => 'feather icon-download-cloud',
                'parent' => $parent,
                'sort' => $sort,
                'class' => null,
                'menu' => 1,
                'depth' => 0,
                'is_custom_menu' => 0
            ]
        );
    }
}
