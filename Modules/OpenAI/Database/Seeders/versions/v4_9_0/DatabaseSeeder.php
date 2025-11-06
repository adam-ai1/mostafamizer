<?php

namespace Modules\OpenAI\Database\Seeders\versions\v4_9_0;

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
            AvatarsTableSeeder::class,
            AvatarMetasTableSeeder::class,
            MenuItemsTableSeeder::class,
            VoicesTableSeeder::class,
        ]);
    }
}
