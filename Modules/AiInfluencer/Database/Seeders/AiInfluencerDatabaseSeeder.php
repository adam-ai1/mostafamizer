<?php

namespace Modules\AiInfluencer\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\AiInfluencer\Database\Seeders\v5_5_0\DatabaseSeeder;

class AiInfluencerDatabaseSeeder extends Seeder
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
            DatabaseSeeder::class
        ]);
    }
}
