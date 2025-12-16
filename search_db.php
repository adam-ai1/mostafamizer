<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== البحث عن النصوص الإنجليزية في قاعدة البيانات ===\n\n";

// البحث عن النصوص المختلفة
$searches = [
    'Our Use Cases help',
    'You can also create a custom use case',
    'Write 10x faster',
    'Create AI art or images',
    'Unlock the power of AI',
    'Save time and money',
    'The Only'
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
