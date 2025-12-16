<?php

namespace Modules\OpenAI\Database\Seeders\versions\v5_4_0;
use Illuminate\Database\Seeder;


class FeaturePreferenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $aiDocChatFeature = \DB::table('feature_preferences')->where('slug', 'ai_doc_chat')->first();

        if ($aiDocChatFeature) {
            \DB::table('feature_preference_metas')->upsert([
                [
                    'owner_type' => 'Modules\OpenAI\Entities\FeaturePreference',
                    'owner_id' => $aiDocChatFeature->id,
                    'type' => 'string',
                    'key' => 'settings',
                    'value' => json_encode([
                        'file_size' => '10',
                    ])
                ]
            ], ['owner_type', 'owner_id', 'key'], ['key']);
        }
    }
}
