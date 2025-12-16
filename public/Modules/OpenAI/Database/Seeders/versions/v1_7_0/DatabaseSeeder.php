<?php

namespace Modules\OpenAI\Database\Seeders\versions\v1_7_0;

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
            FoldersTableSeeder::class,
            PreferencesTableSeeder::class,
            LongArticleMenusItemTableSeeder::class,
            LongArticlePermissionTableSeeder::class,
            LongArticlePreferenceTableSeeder::class
        ]);
    }
}
