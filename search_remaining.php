<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== البحث عن النصوص المتبقية ===\n\n";

$searches = [
    'voxcraft Studio is the ultimate AI-powered',
    'The Only voxcraft Studio Intelligence',
    'Intuitive interface and minimal learning curve make voxcraft'
];

foreach ($searches as $search) {
    echo "--- البحث عن: $search ---\n";
    $results = DB::table('component_properties')
        ->where('value', 'like', "%$search%")
        ->get();
    
    foreach ($results as $r) {
        echo "ID: {$r->id} | Component: {$r->component_id} | Name: {$r->name}\n";
        echo "Value: {$r->value}\n\n";
    }
}
