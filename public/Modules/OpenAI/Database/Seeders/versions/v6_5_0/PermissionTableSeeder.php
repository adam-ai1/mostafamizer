<?php

namespace Modules\OpenAI\Database\Seeders\versions\v6_5_0;

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
        $permissions = [
            [
                'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\UserAccessController@getTheme', 
                'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\UserAccessController', 
                'controller_name' => 'UserAccessController',
                'method_name' => 'getTheme',
            ],
            [
                'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\UserAccessController@toggle', 
                'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\UserAccessController', 
                'controller_name' => 'UserAccessController',
                'method_name' => 'toggle',
            ],
        ];

        foreach ($permissions as $permissionData) {
            $permission = Permission::updateOrCreate(
                ['name' => $permissionData['name']],
                $permissionData
            );

            // Upsert permission_roles
            DB::table('permission_roles')->upsert(
                [
                    'permission_id' => $permission->id,
                    'role_id' => 2,
                ],
                ['permission_id', 'role_id'],
                []
            );
        }
    }
}
