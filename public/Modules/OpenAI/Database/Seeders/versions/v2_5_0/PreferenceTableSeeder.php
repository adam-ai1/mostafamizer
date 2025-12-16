<?php

namespace Modules\OpenAI\Database\Seeders\versions\v2_5_0;

use Illuminate\Database\Seeder;
use DB;

class PreferenceTableSeeder extends Seeder
{
    public function run()
    {
        if (!DB::table('preferences')->where('field', 'user_permission')->exists()) {
            DB::table('preferences')->insert([
                'category' => 'openai',
                'field'    => 'user_permission',
                'value'    => json_encode([
                    'hide_template'       => '0',
                    'hide_image'          => '0',
                    'hide_code'           => '0',
                    'hide_speech_to_text' => '0',
                    'hide_text_to_speech' => '0',
                    'hide_chat'           => '0',
                ]),
            ]);
        }
    }
}
