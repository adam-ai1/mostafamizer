<?php

namespace Modules\Gemini\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Gemini\Database\Seeders\versions\v5_8_0\DatabaseSeeder as DatabaseSeederV5_8_0;

class GeminiDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        $this->call(DatabaseSeederV5_8_0::class);
    }
}
