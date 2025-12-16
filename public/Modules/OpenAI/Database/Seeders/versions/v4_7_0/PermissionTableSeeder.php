<?php

namespace Modules\OpenAI\Database\Seeders\versions\v4_7_0;

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
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController@index', 
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController', 
            'controller_name' => 'VoiceoverController',
            'method_name' => 'index',
        ]);

        Permission::firstOrCreate([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController@show', 
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController', 
            'controller_name' => 'VoiceoverController',
            'method_name' => 'show',
        ]);

        Permission::firstOrCreate([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController@delete', 
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController', 
            'controller_name' => 'VoiceoverController',
            'method_name' => 'delete',
        ]);

        Permission::firstOrCreate([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController@pdf', 
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController', 
            'controller_name' => 'VoiceoverController',
            'method_name' => 'pdf',
        ]);

        Permission::firstOrCreate([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController@csv', 
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController', 
            'controller_name' => 'VoiceoverController',
            'method_name' => 'csv',
        ]);

        Permission::firstOrCreate([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController@allVoices', 
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController', 
            'controller_name' => 'VoiceoverController',
            'method_name' => 'allVoices',
        ]);

        Permission::firstOrCreate([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController@voicePdf', 
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController', 
            'controller_name' => 'VoiceoverController',
            'method_name' => 'voicePdf',
        ]);

        Permission::firstOrCreate([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController@voiceCsv', 
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController', 
            'controller_name' => 'VoiceoverController',
            'method_name' => 'voiceCsv',
        ]);

        Permission::firstOrCreate([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController@voiceEdit', 
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\VoiceoverController', 
            'controller_name' => 'VoiceoverController',
            'method_name' => 'voiceEdit',
        ]);
    }
}
