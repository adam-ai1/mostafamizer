<?php

namespace Modules\FalAi\Database\Seeders\versions\v4_5_0;

use Illuminate\Database\Seeder;

class ProviderManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = \DB::table('preferences')
            ->where(['category' => 'imagemaker', 'field' => 'imagemaker_clipdrop'])
            ->value('value');

        if (empty($value)) {
            return;
        }
        
        $config = json_decode($value, true);

        // Check if 'model' already exists in the config array
        $exists = false;

        if (is_array($config)) {
            foreach ($config as $item) {
                if (is_array($item) && isset($item['name']) && $item['name'] === 'model') {
                    $exists = true;
                    break;
                }
            }
        }

        // If 'model' doesn't exist, append it and update the DB
        if (!$exists) {
            $config[] = [
                'type' => 'dropdown',
                'label' => 'Model',
                'name' => 'model',
                'value' => ['default'],
                'default_value' => 1,
                'visibility' => true,
                'required' => true,
                'admin_visibility' => false,
            ];

            \DB::table('preferences')
                ->where(['category' => 'imagemaker', 'field' => 'imagemaker_clipdrop'])
                ->update(['value' => json_encode($config)]);
        }

    }
}
