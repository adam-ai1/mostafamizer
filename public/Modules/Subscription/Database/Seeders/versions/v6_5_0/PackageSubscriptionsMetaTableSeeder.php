<?php

namespace Modules\Subscription\Database\Seeders\versions\v6_5_0;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

        DB::transaction(function () {
            $existingMetas = PackageSubscriptionMeta::where('key', 'featureAccess')->get();

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
                    DB::table('package_subscriptions_meta')
                        ->where('id', $meta->id)
                        ->update(['value' => json_encode($features)]);
                }
            }

            $allSubscriptions = PackageSubscription::pluck('id');

            foreach ($allSubscriptions as $subscriptionId) {
                $existingMeta = PackageSubscriptionMeta::where([
                    'package_subscription_id' => $subscriptionId,
                    'key' => 'featureAccess'
                ])->exists();

                if (!$existingMeta) {
                    DB::table('package_subscriptions_meta')->insert([
                        'package_subscription_id' => $subscriptionId,
                        'type' => '',
                        'key' => 'featureAccess',
                        'value' => '{"template":"1","long_article":"1","image":"1","video":"1","text_to_video":"1","code":"1","speech_to_text":"1","voiceover":"1","chat":"1","aichatbot":"1","plagiarism":"1","ai_detector":"1","voice_clone":"1","ai_persona":"1","ai_avatar":"1","ai_product_photography":"1","marketing_bot":"0","ai_shorts":"1","url_to_video":"1","influencer_avatar":"1"}'
                    ]);
                }
            }
        });
    }
}
