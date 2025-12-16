<?php

namespace Modules\MarketingBot\Database\Seeders\versions\v6_4_0;
use Illuminate\Database\Seeder;
use DB;


class FeaturePreferenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feature_preferences')->upsert([
            [
                'name' => 'Marketing Bot',
                'slug' => 'marketing-bot',
            ],
        ], [ 'slug' ]);


        $feature = DB::table('feature_preferences')->where('slug', 'marketing-bot')->first();

        if ($feature) {
            $commonData = [
                'owner_type' => 'Modules\OpenAI\Entities\FeaturePreference',
                'owner_id' => $feature->id,
                'type' => 'string'
            ];
        
            $metas = [
                [
                    'key' => 'general_options',
                    'value' => json_encode([
                        'whatsapp' => 'on',
                        'telegram' => 'on',
                        "provider" => "openai",
                        "model" => "text-embedding-ada-002"
                    ])
                ],
                [
                    'key' => 'settings',
                    'value' => json_encode([
                        'conversation' => 'on',
                        'file_size' => '10',
                        'file_limit' => '5',
                        'url_limit' => '5',
                        'training_options' => [
                            'file_upload' => 'on',
                            'website_url' => 'on',
                            'pure_text' => 'on'
                        ]
                    ])
                ]
            ];
        
            $dataToInsert = array_map(function($meta) use ($commonData) {
                return array_merge($commonData, $meta);
            }, $metas);
        
            DB::table('feature_preference_metas')->upsert($dataToInsert, ['owner_type', 'owner_id', 'key'], ['key']);
        }

    }
}