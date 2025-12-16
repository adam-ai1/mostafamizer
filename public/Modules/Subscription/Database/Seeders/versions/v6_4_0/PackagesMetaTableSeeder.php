<?php

namespace Modules\Subscription\Database\Seeders\versions\v6_4_0;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;
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

        $allPackages = Package::pluck('id')->toArray();

        foreach ($allPackages as $packageId) {
            $meta = PackageMeta::where(['package_id' => $packageId, 'key' => 'featureAccess'])->first();
            if (!$meta) {
                DB::table('packages_meta')->upsert([
                    [
                        'package_id' => $packageId,
                        'feature' => '',
                        'key' => 'featureAccess',
                        'value' =>'{"template":"1","long_article":"1","image":"1","video":"1","text_to_video":"1","code":"1","speech_to_text":"1","text_to_speech":"1","chat":"1","aichatbot":"1","plagiarism":"1","ai_detector":"1","voice_clone":"1","ai_persona":"1","ai_avatar":"1","ai_product_photography":"1","marketing_bot":"0","ai_shorts":"1","url_to_video":"1","influencer_avatar":"1"}'
                    ],
                ],['package_id', 'type', 'key']);
            }
        }
    }
}
