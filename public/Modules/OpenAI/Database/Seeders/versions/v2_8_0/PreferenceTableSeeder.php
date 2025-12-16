<?php

namespace Modules\OpenAI\Database\Seeders\versions\v2_8_0;

use Illuminate\Database\Seeder;

class PreferenceTableSeeder extends Seeder
{
    public function run()
    {
        $userPermission =  \DB::table('preferences')->where('field', 'user_permission')->first();

        if ($userPermission) {

            $permission = json_decode($userPermission->value, true);

            if ($permission && array_key_exists('hide_ai_detector', $permission)) {
                return;
            }

            $value = $permission + ['hide_ai_detector' => '0'];
            \DB::table('preferences')->where('field', 'user_permission')->update(['value' => $value]);
        }
    }
}
