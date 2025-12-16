<?php

namespace Modules\OpenAI\Database\Seeders\versions\v6_1_0;

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
                'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\TextToVideoController@getVideo', 
                'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\TextToVideoController', 
                'controller_name' => 'TextToVideoController',
                'method_name' => 'getVideo',
            ],
            [
                'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\ImageToVideoController@getVideo',
                'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\ImageToVideoController', 
                'controller_name' => 'ImageToVideoController',
                'method_name' => 'getVideo',
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
