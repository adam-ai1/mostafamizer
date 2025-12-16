<?php
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$podcasts = DB::table('podcasts')->orderBy('id', 'desc')->limit(5)->get();

echo "=== Latest Podcasts ===\n";
foreach ($podcasts as $p) {
    echo "ID: {$p->id}\n";
    echo "  Status: {$p->status}\n";
    echo "  Script Length: " . strlen($p->script ?? '') . " chars\n";
    $parsed = json_decode($p->parsed_script ?? '[]', true);
    echo "  Parsed Lines: " . count($parsed) . "\n";
    echo "  Audio: " . ($p->audio_path ? 'YES' : 'NO') . "\n";
    echo "  Title: " . mb_substr($p->title ?? 'N/A', 0, 50) . "\n";
    echo str_repeat('-', 40) . "\n";
}
