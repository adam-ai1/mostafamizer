<?php

namespace Modules\OpenAI\Database\Seeders\versions\v5_9_0;

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
                'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\VideoController@index', 
                'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\VideoController', 
                'controller_name' => 'VideoController',
                'method_name' => 'index',
            ],
            [
                'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\VideoController@show',
                'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\VideoController', 
                'controller_name' => 'VideoController',
                'method_name' => 'show',
            ],
            [
                'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\VideoController@destroy', 
                'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\VideoController', 
                'controller_name' => 'VideoController',
                'method_name' => 'destroy',
            ]
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

        $deletePermissions = [
            'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\TextToVideoController@index', 
            'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\TextToVideoController@show', 
            'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\TextToVideoController@destroy', 
        ];

        // Upsert permission_roles

        foreach ($deletePermissions as $deletePermission) {
            $permission = Permission::where('name', $deletePermission)->first();
            if ($permission) {
                DB::table('permission_roles')->where('permission_id', $permission->id)->delete();
                $permission->delete();
            }
        }
    }
}
