<?php

namespace Modules\OpenAI\Database\Seeders\versions\v5_4_0;

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
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\SpeechToTextController@index', 
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\SpeechToTextController', 
            'controller_name' => 'SpeechToTextController',
            'method_name' => 'index',
        ]);

        Permission::firstOrCreate([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\SpeechToTextController@show', 
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\SpeechToTextController', 
            'controller_name' => 'SpeechToTextController',
            'method_name' => 'show',
        ]);

        Permission::firstOrCreate([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\SpeechToTextController@delete', 
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\SpeechToTextController', 
            'controller_name' => 'SpeechToTextController',
            'method_name' => 'delete',
        ]);

        Permission::firstOrCreate([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\SpeechToTextController@update', 
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\v2\\User\\SpeechToTextController', 
            'controller_name' => 'SpeechToTextController',
            'method_name' => 'update',
        ]);
    }
}
