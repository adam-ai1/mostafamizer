<?php

namespace Modules\OpenAI\Database\Seeders\versions\v5_7_0;

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
                'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\SpeechToTextController@index', 
                'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\SpeechToTextController', 
                'controller_name' => 'SpeechToTextController',
                'method_name' => 'index',
            ],
            [
                'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\SpeechToTextController@show', 
                'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\SpeechToTextController', 
                'controller_name' => 'SpeechToTextController',
                'method_name' => 'show',
            ],
            [
                'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\SpeechToTextController@delete', 
                'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\SpeechToTextController', 
                'controller_name' => 'SpeechToTextController',
                'method_name' => 'delete',
            ],
            [
                'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\SpeechToTextController@update', 
                'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\SpeechToTextController', 
                'controller_name' => 'SpeechToTextController',
                'method_name' => 'update',
            ],
            [
                'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\TextToVideoController@index', 
                'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\TextToVideoController', 
                'controller_name' => 'TextToVideoController',
                'method_name' => 'index',
            ],
            [
                'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\TextToVideoController@show', 
                'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\TextToVideoController', 
                'controller_name' => 'TextToVideoController',
                'method_name' => 'show',
            ],
            [
                'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\TextToVideoController@destroy', 
                'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\TextToVideoController', 
                'controller_name' => 'TextToVideoController',
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
    }
}
