<?php

namespace Modules\SmartUpdater\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SmartUpdaterServiceProvider extends ServiceProvider
{
    protected $moduleName = 'SmartUpdater';
    protected $moduleNameLower = 'smartupdater';

    public function boot()
    {
        $this->registerViews();
        $this->registerMenu();
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register menu item automatically
     */
    protected function registerMenu()
    {
        // Only run if menu_items table exists and we're not in console
        if (!$this->app->runningInConsole() && Schema::hasTable('menu_items')) {
            $exists = DB::table('menu_items')->where('link', 'smart-updater')->exists();
            
            if (!$exists) {
                $addonMenu = DB::table('menu_items')->where('label', 'Addon Manager')->first();
                $parent = $addonMenu->parent ?? 0;
                $sort = $addonMenu ? ($addonMenu->sort + 1) : 59;

                DB::table('menu_items')->insert([
                    'label' => 'Smart Updater',
                    'link' => 'smart-updater',
                    'params' => '{"permission":"Modules\\\\SmartUpdater\\\\Http\\\\Controllers\\\\SmartUpdaterController@index", "route_name":["smart-updater.index"], "menu_level":"1"}',
                    'is_default' => 1,
                    'icon' => 'feather icon-download-cloud',
                    'parent' => $parent,
                    'sort' => $sort,
                    'class' => null,
                    'menu' => 1,
                    'depth' => 0,
                    'is_custom_menu' => 0
                ]);
            }
        }
    }

    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);
        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
