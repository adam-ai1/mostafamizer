<?php

namespace Modules\OpenAI\Database\Seeders\versions\v4_6_0;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::firstOrCreate([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\PrebuiltTemplateContentController@edit', 
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\PrebuiltTemplateContentController', 
            'controller_name' => 'PrebuiltTemplateContentController',
            'method_name' => 'edit',
        ]);

        Permission::firstOrCreate([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\PrebuiltTemplateContentController@delete', 
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\PrebuiltTemplateContentController', 
            'controller_name' => 'PrebuiltTemplateContentController',
            'method_name' => 'delete',
        ]);
    }
}
