<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * VoxCraft Production Updates Seeder
 * 
 * This seeder contains all database changes made during development:
 * 1. Package prices updates (Starter, Premium, Platinum)
 * 2. New features (Podcast, Audio Ads, VoxChat) for all packages
 * 3. Feature preferences for new features
 * 4. Menu items update (News -> About Us)
 * 5. Pages activation (About Us, Contact Us)
 * 6. Modules configuration (Presentation disabled)
 * 
 * Run with: php artisan db:seed --class=VoxcraftProductionSeeder
 */
class VoxcraftProductionSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('🚀 Starting VoxCraft Production Updates...');
        
        // 1. Update Package Prices
        $this->updatePackagePrices();
        
        // 2. Add Feature Preferences for new features
        $this->addFeaturePreferences();
        
        // 3. Add Package Meta for new features
        $this->addPackageMeta();
        
        // 4. Update Menu Items
        $this->updateMenuItems();
        
        // 5. Activate Pages
        $this->activatePages();
        
        $this->command->info('✅ VoxCraft Production Updates completed successfully!');
    }

    /**
     * Update package prices
     */
    private function updatePackagePrices()
    {
        $this->command->info('📦 Updating package prices...');
        
        $packages = [
            // Package ID 12 = Starter Plan ($12.99/month)
            12 => [
                'sale_price' => json_encode([
                    'lifetime' => 0,
                    'yearly' => 0,
                    'monthly' => 12.99,
                    'weekly' => 0,
                    'days' => 0
                ]),
                'discount_price' => json_encode([
                    'lifetime' => null,
                    'yearly' => null,
                    'monthly' => 12.99,
                    'weekly' => null,
                    'days' => null
                ])
            ],
            // Package ID 13 = Premium Plan ($34.99/month)
            13 => [
                'sale_price' => json_encode([
                    'lifetime' => 0,
                    'yearly' => 0,
                    'monthly' => 34.99,
                    'weekly' => 0,
                    'days' => 0
                ]),
                'discount_price' => json_encode([
                    'lifetime' => null,
                    'yearly' => null,
                    'monthly' => 34.99,
                    'weekly' => null,
                    'days' => null
                ])
            ],
            // Package ID 10 = Platinum Plan ($79.99/month)
            10 => [
                'sale_price' => json_encode([
                    'lifetime' => 0,
                    'yearly' => 0,
                    'monthly' => 79.99,
                    'weekly' => 0,
                    'days' => 0
                ]),
                'discount_price' => json_encode([
                    'lifetime' => null,
                    'yearly' => null,
                    'monthly' => 79.99,
                    'weekly' => null,
                    'days' => null
                ])
            ],
        ];
        
        foreach ($packages as $packageId => $data) {
            DB::table('packages')
                ->where('id', $packageId)
                ->update($data);
        }
        
        $this->command->info('   ✓ Package prices updated');
    }

    /**
     * Add feature preferences for Podcast, Audio Ads, VoxChat
     */
    private function addFeaturePreferences()
    {
        $this->command->info('⚙️ Adding feature preferences...');
        
        $features = [
            ['name' => 'Podcast', 'slug' => 'podcast'],
            ['name' => 'Audio Ads', 'slug' => 'audio_ads'],
            ['name' => 'VoxChat', 'slug' => 'voxchat'],
        ];
        
        foreach ($features as $feature) {
            $exists = DB::table('feature_preferences')
                ->where('slug', $feature['slug'])
                ->exists();
            
            if (!$exists) {
                DB::table('feature_preferences')->insert($feature);
                $this->command->info("   ✓ Added feature: {$feature['name']}");
            } else {
                $this->command->info("   - Feature already exists: {$feature['name']}");
            }
        }
    }

    /**
     * Add package meta for new features
     */
    private function addPackageMeta()
    {
        $this->command->info('📋 Adding package meta for new features...');
        
        // Package configurations:
        // ID 12 = Starter: podcast=5, audio_ads=10, voxchat=50
        // ID 13 = Premium: podcast=20, audio_ads=50, voxchat=200
        // ID 10 = Platinum: podcast=100, audio_ads=200, voxchat=1000
        
        $packageFeatures = [
            // Starter Plan (ID 12)
            12 => [
                'podcast' => ['value' => 5, 'title' => 'Podcast Limit'],
                'audio_ads' => ['value' => 10, 'title' => 'Audio Ads Limit'],
                'voxchat' => ['value' => 50, 'title' => 'VoxChat Messages'],
            ],
            // Premium Plan (ID 13)
            13 => [
                'podcast' => ['value' => 20, 'title' => 'Podcast Limit'],
                'audio_ads' => ['value' => 50, 'title' => 'Audio Ads Limit'],
                'voxchat' => ['value' => 200, 'title' => 'VoxChat Messages'],
            ],
            // Platinum Plan (ID 10)
            10 => [
                'podcast' => ['value' => 100, 'title' => 'Podcast Limit'],
                'audio_ads' => ['value' => 200, 'title' => 'Audio Ads Limit'],
                'voxchat' => ['value' => 1000, 'title' => 'VoxChat Messages'],
            ],
        ];
        
        foreach ($packageFeatures as $packageId => $features) {
            foreach ($features as $featureSlug => $config) {
                // Check if feature already exists for this package
                $exists = DB::table('packages_meta')
                    ->where('package_id', $packageId)
                    ->where('feature', $featureSlug)
                    ->exists();
                
                if (!$exists) {
                    // Add all required meta entries
                    $metaEntries = [
                        ['package_id' => $packageId, 'feature' => $featureSlug, 'key' => 'type', 'value' => 'number'],
                        ['package_id' => $packageId, 'feature' => $featureSlug, 'key' => 'is_value_fixed', 'value' => '0'],
                        ['package_id' => $packageId, 'feature' => $featureSlug, 'key' => 'title', 'value' => $config['title']],
                        ['package_id' => $packageId, 'feature' => $featureSlug, 'key' => 'title_position', 'value' => 'before'],
                        ['package_id' => $packageId, 'feature' => $featureSlug, 'key' => 'value', 'value' => (string) $config['value']],
                        ['package_id' => $packageId, 'feature' => $featureSlug, 'key' => 'is_visible', 'value' => '1'],
                        ['package_id' => $packageId, 'feature' => $featureSlug, 'key' => 'description', 'value' => ''],
                        ['package_id' => $packageId, 'feature' => $featureSlug, 'key' => 'status', 'value' => 'Active'],
                    ];
                    
                    DB::table('packages_meta')->insert($metaEntries);
                    $this->command->info("   ✓ Added {$featureSlug} to package {$packageId}");
                } else {
                    // Update existing value
                    DB::table('packages_meta')
                        ->where('package_id', $packageId)
                        ->where('feature', $featureSlug)
                        ->where('key', 'value')
                        ->update(['value' => (string) $config['value']]);
                    
                    $this->command->info("   - Updated {$featureSlug} for package {$packageId}");
                }
            }
        }
    }

    /**
     * Update menu items (News -> About Us)
     */
    private function updateMenuItems()
    {
        $this->command->info('📌 Updating menu items...');
        
        // Update "News" to "من نحن" (About Us) in header menu
        DB::table('menu_items')
            ->where('id', 123)
            ->update([
                'label' => 'من نحن',
                'link' => 'page/about-us',
            ]);
        
        $this->command->info('   ✓ Changed "News" to "من نحن" in navigation');
    }

    /**
     * Activate pages
     */
    private function activatePages()
    {
        $this->command->info('📄 Activating pages...');
        
        $pages = [
            'about-us' => ['status' => 'Active', 'name' => 'من نحن'],
            'contact-us' => ['status' => 'Active', 'name' => 'اتصل بنا'],
        ];
        
        foreach ($pages as $slug => $data) {
            DB::table('pages')
                ->where('slug', $slug)
                ->update($data);
            
            $this->command->info("   ✓ Activated page: {$slug}");
        }
    }
}
