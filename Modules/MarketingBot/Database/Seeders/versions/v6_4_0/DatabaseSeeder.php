<?php

namespace Modules\MarketingBot\Database\Seeders\versions\v6_4_0;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            FeaturePreferenceTableSeeder::class,
            CountriesTableSeeder::class,
        ]);
    }
}
