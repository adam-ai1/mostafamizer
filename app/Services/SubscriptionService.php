<?php

/**
 * @package SubscriptionService
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Mostafijur Rahman <[mostafijur.techvill@gmail.com]>
 * @created 30-03-2023
 */

namespace App\Services;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Coupon\Services\CouponService;
use Modules\Gateway\Facades\GatewayHelper;
use Modules\Subscription\Services\PackageSubscriptionService;
use Modules\Subscription\Entities\{
    Credit,
    Package,
    PackageSubscription,
    PackageSubscriptionMeta,
    SubscriptionDetails
};
use Modules\Subscription\Services\CreditService;
use Nwidart\Modules\Facades\Module;

class SubscriptionService
{
    /**
     * Package Subscription Service
     *
     * @var $packageSubscriptionService
     */
    protected $packageSubscriptionService;


    /**
     * Constructor for SubscriptionService
     *
     * @param PackageSubscriptionService $packageSubscriptionService
     * @return void
     */
    public function __construct(PackageSubscriptionService $packageSubscriptionService)
    {
        $this->packageSubscriptionService = $packageSubscriptionService;
    }


    /**
     * Prepare Subscription data
     *
     * @return void
     */
    public function prepareData($data, $features)
    {
        $request['package_subscription_id'] = $data->id;
        $request['code'] = $data->code;
        $request['unique_code'] = $this->packageSubscriptionService->generateUniqueCode();
        $request['user_id'] = $data->user_id;
        $request['package_id'] = $data->package_id;
        $request['is_trial'] = boolval(subscription('isUsedTrial', $data->package_id) ? 0 : $data->trial);
        $request['activation_date'] = $data->activation_date;
        $request['billing_date'] = $data->billing_date;
        $request['next_billing_date'] = $data->next_billing_date;
        $request['billing_price'] = $data->billing_price;
        $request['billing_cycle'] = $data->billing_cycle;
        $request['amount_billed'] = $data->billing_price;
        $request['currency'] = \App\Models\Currency::getDefault()->name;
        $request['payment_status'] = $data->payment_status;
        $request['status'] = $data->status;
        $request['feature'] = json_encode($features);

        return $request;
    }

    /**
     * Store subscription details
     *
     * @return object
     */
    public function storeSubscriptionDetails(int|null $userId = null)
    {
        $packageSubscription = $this->packageSubscriptionService->getUserSubscription($userId, true);
        $features = $this->packageSubscriptionService->getFeatureList();
        $a = [];

        foreach ($features as $key => $feature) {
            $a[] = $this->packageSubscriptionService->getFeatureOption($packageSubscription->id, (string)$feature);
        }

        $data = $this->prepareData($packageSubscription, $features);
        $subscriptionDetails = SubscriptionDetails::create($data);

        return $subscriptionDetails;
    }

    /**
     * Get plan description data
     *
     * @return String $id
     */
    public function planDescription(string $id)
    {
        $data['package'] = Package::with('metadata')->find($id);
        $data['features'] = $this->getFeatures($data['package']);
        return $data;
    }


    /**
     * get Feature
     *
     * @param Package $package
     * @param bool $option
     * @return \App\Lib\MiniCollection
     */
    public static function getFeatures(Package $package, $option = true)
    {
        $features = $package->metaData()->whereNot('feature', '')->get();
        $formatFeature = [];

        foreach ($features as $data) {
            $formatFeature[$data->feature][$data->key] = $data->value;
        }

        if (!$option) {
            return $formatFeature;
        }

        return miniCollection($formatFeature, true);
    }

    /**
     * Updated subscription data
     *
     * @param Request $request
     * @return $packageSubscription
     */
    public function subscriptionPaid(Request $request)
    {
        $code = techDecrypt($request->code);
        $packageSubscriptionDetail = SubscriptionDetails::where('unique_code', $code)->first();
        $packageSubscription = PackageSubscription::where('code', $packageSubscriptionDetail->code)->first();

        if (!$packageSubscriptionDetail) {

            throw new \Exception(__('Subscription not found.'));
        }

        $log = GatewayHelper::getPaymentLog($code);

        if (!$log) {

            throw new \Exception(__('Subscription not found.'));
        }

        if (!Auth::id()) {
            $user = User::find($packageSubscriptionDetail->user_id);
            Auth::login($user);
        }
        
        (new CouponService)->storeCouponRedeem($packageSubscriptionDetail->id, $packageSubscriptionDetail->package_id);

        if ($log->status == 'completed') {
            SubscriptionDetails::where('status', 'Active')->where('user_id', Auth::id())->update(['status' => 'Expired']);
            
            CouponService::updateCouponRedeemStatus($packageSubscriptionDetail->id);

            $data = json_decode($log->response);
            $packageSubscriptionDetail->amount_received = $data->amount;
            $packageSubscriptionDetail->payment_status = "Paid";
            $packageSubscriptionDetail->status = 'Active';

            $packageSubscription->amount_received = $data->amount;
            $packageSubscription->amount_due = '0';
            $packageSubscription->payment_status = "Paid";
            $packageSubscription->status = 'Active';
        }

        $packageSubscriptionDetail->payment_method = $log->gateway;

        $packageSubscription->save();
        $packageSubscriptionDetail->save();

        return $packageSubscriptionDetail;
    }

    /**
     * Get activePackage
     *
     * @return Object $response
     */
    public function activePackage()
    {

        if (Auth::check() && PackageSubscription::where('user_id', Auth::user()->id)->count() > 0) {
            $activePlan = PackageSubscription::where('user_id', Auth::user()->id)->latest()->first();
            return Package::find($activePlan->package_id);
        }

        return Package::with('metadata')->first();
    }

    /**
     * Paid pending subscription
     *
     * @param Request $request
     */
    public function paidPendingSubscription(Request $request)
    {
        $code = techDecrypt($request->code);
        $subscriptionDetails = SubscriptionDetails::where('unique_code', $code)->first();

        if (!$subscriptionDetails) {
            throw new \Exception(__('Subscription not found.'));
        }

        $log = GatewayHelper::getPaymentLog($code);

        if (!$log) {
            throw new \Exception(__('Subscription not found.'));
        }

        if (!Auth::id()) {
            $user = User::find($subscriptionDetails->user_id);
            Auth::login($user);
        }
        
        if ($subscriptionDetails->billing_cycle) {
            $response = $this->packageSubscriptionService->storePackage($subscriptionDetails->package_id, $subscriptionDetails->user_id, $subscriptionDetails->billing_cycle);

            if ($response['status'] != 'success') {
                throw new \Exception(__('Subscription fail.'));
            }
        }

        $subscription = $this->packageSubscriptionService->getSubscription($subscriptionDetails->package_subscription_id, 'id', true);
        
        (new CouponService)->storeCouponRedeem($subscriptionDetails->id, $subscriptionDetails->package_id);

        if ($log->status == 'completed') {
            if (!$subscriptionDetails->billing_cycle) {
                return (new CreditService)->manualPaid($subscriptionDetails);
            }
            
            CouponService::updateCouponRedeemStatus($subscriptionDetails->id);
            
            SubscriptionDetails::where('status', 'Active')->where('user_id', Auth::id())->update(['status' => 'Expired']);

            $data = json_decode($log->response);

            $subscription->update([
                'payment_status' => "Paid",
                'status' => 'Active'
            ]);

            $subscriptionDetails->update([
                'amount_received' => $data->amount,
                'payment_status' => 'Paid',
                'status' => 'Active',
                'payment_method' => $log->gateway
            ]);
        }

        return $subscriptionDetails;
    }

     /**
     * Paid pending subscription
     *
     * @param Request $request
     */
    public function subscriptionUpdatePaid(Request $request)
    {
        $code = techDecrypt($request->code);

        $log = GatewayHelper::getPaymentLog($code);

        if (!$log) {
            throw new \Exception(__('Subscription not found.'));
        }

        $userId = $log->sending_details->user_id ?? null;

        if (!Auth::id() && $userId) {
            $user = User::find($userId);
            Auth::login($user);
        }
        
        $isOfflineGateway = Module::find($log->gateway)->get('offline');

        $packageId = $log->sending_details->package_id ?? null;
        $billingCycle = $log->sending_details->billing_cycle ?? null;

        if (!$packageId || !$billingCycle) {
            throw new \Exception(__('Subscription not found.'));
        }

        $response = $this->packageSubscriptionService->storePackage($packageId, Auth::id(), $billingCycle);

        if ($response['status'] != 'success') {
            throw new \Exception(__('Subscription fail.'));
        }
        
        $subscriptionDetails = subscription('storeSubscriptionDetails', null, null, $code);
    
        if (!$subscriptionDetails) {
            throw new \Exception(__('Subscription not found.'));
        }

        $subscription = $this->packageSubscriptionService->getSubscription($subscriptionDetails->package_subscription_id, 'id', true);
        
        (new CouponService)->storeCouponRedeem($subscriptionDetails->id, $subscriptionDetails->package_id);
    
        SubscriptionDetails::where('status', 'Active')->where('user_id', Auth::id())->update(['status' => 'Expired']);
        
        CouponService::updateCouponRedeemStatus($subscriptionDetails->id);

        if ($log->status == 'completed') {
            $data = json_decode($log->response);

            $subscription->update([
                'payment_status' => "Paid",
                'status' => 'Active'
            ]);

            $subscriptionDetails->update([
                'amount_received' => $data->amount,
                'payment_status' => 'Paid',
                'status' => 'Active',
                'payment_method' => $log->gateway
            ]);

            $log->update([
                'sending_details' => json_encode($subscriptionDetails)
            ]);
        }   

        return $subscriptionDetails;
    }

    /**
     * Credit paid
     *
     * @param Request $request
     */
    public function creditPaid(Request $request)
    {
        $code = techDecrypt($request->code);

        $log = GatewayHelper::getPaymentLog($code);

        if (!$log) {
            throw new \Exception(__('Payment not found.'));
        }

        if (!Auth::id()) {
            $user = User::find($log->sending_details->user_id);
            Auth::login($user);
        }

        $data = json_decode($log->response);

        $credit = Credit::find($log->sending_details->package_id);

        if (!$credit) {
            throw new \Exception(__('Plan not found.'));
        }

        $subscriptionDetails = SubscriptionDetails::create([
            'package_subscription_id' => 0,
            'code' => 'onetime',
            'unique_code' => $code,
            'user_id' => auth()->user()->id,
            'package_id' => $log->sending_details->package_id,
            'is_trial' => 0,
            'renewable' => 0,
            'activation_date' => now(),
            'billing_date' => now(),
            'next_billing_date' => null,
            'billing_price' => $credit->price,
            'billing_cycle' => null,
            'amount_billed' => $credit->price - (new CouponService)->getDiscountAmount($log->sending_details->package_id, auth()->user()->id, 'onetime'),
            'amount_received' => 0,
            'currency' => Currency::getDefault()?->name,
            'payment_status' => 'Unpaid',
            'status' => 'Pending',
            'features' => json_encode($credit->features),
            'payment_method' => $log->gateway
        ]);

        if (!$subscriptionDetails) {
            throw new \Exception(__('History not found.'));
        }
        
        (new CouponService)->storeCouponRedeem($subscriptionDetails->id, $subscriptionDetails->package_id, 'Inactive', 'onetime');

        if ($log->status == 'completed') {
            $subscriptionDetails->update([
                'amount_received' => $data->amount,
                'payment_status' => 'Paid',
                'status' => 'Expired',
                'payment_method' => $log->gateway
            ]);

            foreach ($credit->features as $key => $value) {
                $oldValueLimit = intval(auth()->user()->getMeta($key . '_limit'));
                $oldValueUsed = intval(auth()->user()->getMeta($key . '_used'));
                
                auth()->user()->setMeta($key . '_used', $oldValueUsed);
                if ($oldValueLimit != -1) {
                    auth()->user()->setMeta($key . '_limit', $oldValueLimit + $value);
                }
                
                auth()->user()->save();
            }

            $log->update([
                'sending_details' => json_encode($subscriptionDetails)
            ]);
            
            CouponService::updateCouponRedeemStatus($subscriptionDetails->id);
        }

        return $subscriptionDetails;
    }

    /**
     * get user subcriptio details
     *
     * @return array
     */
    public function getUserSubcriptionDetails()
    {
        return SubscriptionDetails::where('user_id', auth()->user()->id)->first();
    }

    /**
     * Store Free Credit
     *
     * @param object $credit
     * @param object $subscription
     */
    public function storeFreeCredit($credit, $userId = null)
    {
        if (!is_null($userId)) {
            $user = User::find($userId);
        } else {
            $user = auth()->user();
        }

        $details = SubscriptionDetails::create([
            'package_subscription_id' => 0,
            'code' => 'onetime',
            'unique_code' => $this->packageSubscriptionService->generateUniqueCode(),
            'user_id' => $user->id,
            'package_id' => $credit->id,
            'is_trial' => 0,
            'renewable' => 0,
            'activation_date' => now(),
            'billing_date' => now(),
            'next_billing_date' => null,
            'billing_price' => 0,
            'billing_cycle' => null,
            'amount_billed' => 0,
            'amount_received' => 0,
            'currency' => Currency::getDefault()?->name,
            'payment_status' => 'Paid',
            'status' => 'Expired',
            'features' => json_encode($credit->features),
            'payment_method' => null
        ]);

        // Force load metaData before using getMeta (fixes lazy loading issue)
        $user->metaData;

        foreach ($credit->features as $key => $value) {
            $oldValueLimit = intval($user->getMeta($key . '_limit'));
            $oldValueUsed = intval($user->getMeta($key . '_used'));
            
            $user->setMeta($key . '_used', $oldValueUsed);
            if ($oldValueLimit != -1) {
                $user->setMeta($key . '_limit', $oldValueLimit + $value);
            }
            
            $user->save();
        }
        
        (new CouponService)->storeCouponRedeem($details->id, $details->package_id, 'Active', 'onetime');

        // Create package_subscription for the free package so features like VoxChat work
        $this->createFreePackageSubscription($user->id, $credit);

        return [
            'status' => 'success',
            'message' => __('You have successfully purchase the plan.')
        ];
    }

    /**
     * Create a free package subscription for new users
     *
     * @param int $userId
     * @param object $credit
     * @return void
     */
    protected function createFreePackageSubscription($userId, $credit)
    {
        // Find the free package (code = 'default')
        $freePackage = Package::where('code', 'default')->first();
        
        if (!$freePackage) {
            return; // No free package found
        }

        // Check if user already has a package subscription
        $existingSubscription = PackageSubscription::where('user_id', $userId)->first();
        if ($existingSubscription) {
            return; // Already has a subscription
        }

        // Create package subscription
        $subscription = PackageSubscription::create([
            'code' => $this->packageSubscriptionService->generateUniqueCode(),
            'user_id' => $userId,
            'package_id' => $freePackage->id,
            'activation_date' => now(),
            'billing_date' => now(),
            'next_billing_date' => now()->addYears(100), // Essentially unlimited
            'billing_price' => 0,
            'billing_cycle' => 'lifetime',
            'amount_billed' => 0,
            'amount_received' => 0,
            'amount_due' => 0,
            'is_trial' => 0,
            'renewable' => 0,
            'payment_status' => 'Paid',
            'status' => 'Active',
        ]);

        // Add subscription meta for features using DB::table
        $features = $credit->features ?? [];
        foreach ($features as $feature => $value) {
            \DB::table('package_subscriptions_meta')->insert([
                'package_subscription_id' => $subscription->id,
                'type' => 'feature_' . $feature,
                'key' => 'value',
                'value' => (string) $value,
            ]);
            \DB::table('package_subscriptions_meta')->insert([
                'package_subscription_id' => $subscription->id,
                'type' => 'feature_' . $feature,
                'key' => 'status',
                'value' => 'Active',
            ]);
            \DB::table('package_subscriptions_meta')->insert([
                'package_subscription_id' => $subscription->id,
                'type' => 'feature_' . $feature,
                'key' => 'usage',
                'value' => '0',
            ]);
        }

        // Add feature access meta as single JSON record (correct format)
        $featureAccess = [
            'template' => '1',
            'long_article' => '0',
            'image' => '1',
            'video' => '1',
            'text_to_video' => '0',
            'code' => '1',
            'speech_to_text' => '1',
            'voiceover' => '1',
            'ai-duo-podcast' => '1',
            'audio-ads' => '1',
            'seo-analyzer' => '1',
            'presentation' => '0',
            'chat' => '1',
            'aichatbot' => '0',
            'plagiarism' => '0',
            'ai_detector' => '0',
            'voice_clone' => '0',
            'ai_persona' => '0',
            'ai_avatar' => '0',
            'ai_product_photography' => '0',
            'marketing_bot' => '0',
            'ai_shorts' => '0',
            'url_to_video' => '0',
            'influencer_avatar' => '0',
            'voxchat' => '1',
        ];

        \DB::table('package_subscriptions_meta')->insert([
            'package_subscription_id' => $subscription->id,
            'type' => 'featureAccess',
            'key' => 'featureAccess',
            'value' => json_encode($featureAccess),
        ]);
    }
}
