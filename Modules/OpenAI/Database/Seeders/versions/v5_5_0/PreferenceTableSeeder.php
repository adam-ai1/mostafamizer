<?php

namespace Modules\OpenAI\Database\Seeders\versions\v5_5_0;

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
        $providers = [
            'speechtotext_openai',
            'speechtotext_azureopenai',
            'speechtotext_gemini',
        ];

        foreach ($providers as $field) {
            $row = DB::table('preferences')->where('field', $field)->first();
            if ($row) {
                $values = json_decode($row->value, true);

                foreach ($values as &$value) {
                    if ($value['name'] === 'temperature') {
                        $value['value'] = array_map('strval', $value['value']);
                        if (isset($value['default_value'])) {
                            $value['default_value'] = (string) $value['default_value'];
                        }
                    }
                }
                unset($value);

                // Save back to DB
                \DB::table('preferences')
                    ->where('field', $field)
                    ->update(['value' => json_encode($values)]);
            }
        }
    }
}
