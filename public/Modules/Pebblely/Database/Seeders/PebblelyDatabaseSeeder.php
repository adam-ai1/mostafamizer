<?php

namespace Modules\Pebblely\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Pebblely\Database\Seeders\versions\v5_2_0\ProductBackgroundsTableSeeder;

class PebblelyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call([
            ProductBackgroundsTableSeeder::class,
        ]);
    }
}
