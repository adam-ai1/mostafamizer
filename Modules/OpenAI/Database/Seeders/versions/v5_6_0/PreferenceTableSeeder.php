<?php

namespace Modules\OpenAI\Database\Seeders\versions\v5_6_0;

use Illuminate\Database\Seeder;
use DB;

class PreferenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $imageMaker = DB::table('preferences')->where(['field' => 'imagemaker_clipdrop'])->first();

        if ($imageMaker) {
            $values = json_decode($imageMaker->value, true);

            foreach ($values as &$value) {
                if ($value['name'] === 'service' && isset($value['value']) && is_array($value['value'])) {
                    // Filter out "sketch-to-image"
                    $value['value'] = array_values(array_filter($value['value'], function ($item) {
                        return $item !== 'sketch-to-image';
                    }));
                }
            }
            unset($value);

            // Save back to DB
            DB::table('preferences')->where(['field' => 'imagemaker_clipdrop'])->update(['value' => json_encode($values)]);
        }

        DB::table('preferences')->where('field', 'videomaker_stabilityai')->delete();

        // Filter out "stable-diffusion-v1-6"
        $stabilityAi = DB::table('preferences')->where(['field' => 'imagemaker_stabilityai'])->first();

        if ($stabilityAi) {
            $values = json_decode($stabilityAi->value, true);

            foreach ($values as &$value) {
                if ($value['name'] === 'model' && isset($value['value']) && is_array($value['value'])) {
                    // Filter out "stable-diffusion-v1-6"
                    $value['value'] = array_values(array_filter($value['value'], function ($item) {
                        return $item !== 'stable-diffusion-v1-6';
                    }));
                }
            }
            unset($value);

            // Save back to DB
            DB::table('preferences')->where(['field' => 'imagemaker_stabilityai'])->update(['value' => json_encode($values)]);
        }
    }
}
