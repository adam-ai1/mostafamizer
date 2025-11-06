<?php

namespace Modules\FalAi\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\FalAi\Database\Seeders\versions\v4_0_0\DatabaseSeeder;
use Modules\FalAi\Database\Seeders\versions\v4_5_0\DatabaseSeeder as DatabaseSeederV45;

class FalAiDatabaseSeeder extends Seeder
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
            DatabaseSeeder::class,
            DatabaseSeederV45::class
        ]);
    }
}
