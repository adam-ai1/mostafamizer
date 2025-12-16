<?php

namespace Modules\Subscription\Database\Seeders\versions\v6_4_0;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;
use Modules\Subscription\Entities\{
    PackageSubscription,
    PackageSubscriptionMeta
};

class PackageSubscriptionsMetaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $subscriptions = PackageSubscription::pluck('id');
        
        foreach ($subscriptions as $subscriptionId) {
            $meta = PackageSubscriptionMeta::where(['package_subscription_id' => $subscriptionId, 'key' => 'featureAccess'])->first();
            if (!$meta) {
                DB::table('package_subscriptions_meta')->upsert([
                    [
                        'package_subscription_id' => $subscriptionId,
                        'type' => '',
                        'key' => 'featureAccess',
                        'value' =>'{"template":"1","long_article":"1","image":"1","video":"1","text_to_video":"1","code":"1","speech_to_text":"1","text_to_speech":"1","chat":"1","aichatbot":"1","plagiarism":"1","ai_detector":"1","voice_clone":"1","ai_persona":"1","ai_avatar":"1","ai_product_photography":"1","marketing_bot":"0","ai_shorts":"1","url_to_video":"1","influencer_avatar":"1"}'
                    ],
                ],['type', 'key']);
            }
        }
    }
}
