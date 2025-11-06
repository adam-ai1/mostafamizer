<?php

namespace Modules\Gemini\Database\Seeders\versions\v5_8_0;

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
            VoiceTableSeeder::class
        ]);
    }
}
