<?php

namespace Modules\OpenAI\Database\Seeders\versions\v4_6_0;

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
            PermissionTableSeeder::class,
        ]);
    }
}
