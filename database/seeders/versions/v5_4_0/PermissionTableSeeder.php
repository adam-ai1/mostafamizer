<?php

namespace Database\seeders\versions\v5_4_0;

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {

        \DB::table('permissions')->insert([
            [
                'controller_name' => 'SystemConfigurationController',
                'controller_path' => 'App\\Http\\Controllers\\SystemConfigurationController',
                'method_name' => 'settings',
                'name' => 'App\\Http\\Controllers\\SystemConfigurationController@settings',
            ],
        ]);
    }
}
