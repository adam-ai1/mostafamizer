<?php

namespace Modules\SmartUpdater\Database\Seeders;

use Illuminate\Database\Seeder;

class SmartUpdaterDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            MenuItemsTableSeeder::class,
        ]);
    }
}
