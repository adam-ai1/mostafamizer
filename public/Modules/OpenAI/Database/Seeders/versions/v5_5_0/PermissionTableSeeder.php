<?php

namespace Modules\OpenAI\Database\Seeders\versions\v5_5_0;

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
        $permissionData = [
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\UserController@sidebar', 
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\UserController', 
            'controller_name' => 'UserController',
            'method_name' => 'sidebar',
        ];

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
