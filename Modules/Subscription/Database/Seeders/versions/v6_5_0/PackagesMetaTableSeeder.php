<?php

namespace Modules\Subscription\Database\Seeders\versions\v6_5_0;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Subscription\Entities\{
    Package,
    PackageMeta
};

class PackagesMetaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::transaction(function () {
            $existingMetas = PackageMeta::where('key', 'featureAccess')->get();

            foreach ($existingMetas as $meta) {
                $features = json_decode($meta->value, true);

                if (isset($features['text_to_speech'])) {
                    // Add voiceover if it doesn't exist
                    if (!isset($features['voiceover'])) {
                        $features['voiceover'] = $features['text_to_speech'];
                    }
                    // Remove old text_to_speech key
                    unset($features['text_to_speech']);

                    // Update the record
                    DB::table('packages_meta')
                        ->where('id', $meta->id)
                        ->update(['value' => json_encode($features)]);
                }
            }

            $allPackages = Package::pluck('id');

            foreach ($allPackages as $packageId) {
                $existingMeta = PackageMeta::where([
                    'package_id' => $packageId,
                    'key' => 'featureAccess'
                ])->exists();

                if (!$existingMeta) {
                    DB::table('packages_meta')->insert([
                        'package_id' => $packageId,
                        'feature' => '',
                        'key' => 'featureAccess',
                        'value' => '{"template":"1","long_article":"1","image":"1","video":"1","text_to_video":"1","code":"1","speech_to_text":"1","voiceover":"1","chat":"1","aichatbot":"1","plagiarism":"1","ai_detector":"1","voice_clone":"1","ai_persona":"1","ai_avatar":"1","ai_product_photography":"1","marketing_bot":"0","ai_shorts":"1","url_to_video":"1","influencer_avatar":"1"}'
                    ]);
                }
            }
        });
    }
}
