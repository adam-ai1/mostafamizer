<?php

namespace Modules\SmartUpdater\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $moduleNamespace = 'Modules\SmartUpdater\Http\Controllers';

    public function boot()
    {
        parent::boot();
        $this->routes(function () {
            $this->mapWebRoutes();
        });
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('SmartUpdater', '/Routes/web.php'));
    }
}
