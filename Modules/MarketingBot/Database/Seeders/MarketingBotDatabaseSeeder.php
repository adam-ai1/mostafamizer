<?php

namespace Modules\MarketingBot\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\MarketingBot\Database\Seeders\versions\v6_4_0\DatabaseSeeder;

class MarketingBotDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(DatabaseSeeder::class);
    }
}
