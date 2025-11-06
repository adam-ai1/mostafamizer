<?php

namespace Modules\FalAi\Database\Seeders\versions\v4_5_0;

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
            ProviderManagerSeeder::class
        ]);
    }
}
