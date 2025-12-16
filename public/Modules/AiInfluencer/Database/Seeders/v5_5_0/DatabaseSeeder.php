<?php

namespace Modules\AiInfluencer\Database\Seeders\v5_5_0;

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
            MenuItemsTableSeeder::class
        ]);
    }
}
