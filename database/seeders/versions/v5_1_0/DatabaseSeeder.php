<?php

namespace Database\Seeders\versions\v5_1_0;

use Illuminate\Database\Seeder;

use Database\Seeders\versions\v1_6_0\EmailTemplatesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            EmailTemplatesTableSeeder::class,
        ]);
    }
}
