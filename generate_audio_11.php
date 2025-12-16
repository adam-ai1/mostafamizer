<?php

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\OpenAI\Entities\Podcast;
use Modules\OpenAI\Services\PodcastService;

// Increase time limits
set_time_limit(900);
ini_set('max_execution_time', 900);

$podcast = Podcast::find(11);

if (!$podcast) {
    echo "Podcast not found\n";
    exit(1);
}

echo "=== Podcast 11 Status ===\n";
echo "Status: {$podcast->status}\n";
echo "Has Script: " . (!empty($podcast->script) ? 'Yes' : 'No') . "\n";
echo "Parsed Lines: " . count($podcast->parsed_script ?? []) . "\n\n";

$service = app(PodcastService::class);

// Generate audio directly
echo "=== Generating Audio ===\n";
echo "Starting at: " . date('H:i:s') . "\n";

$result = $service->generatePodcastAudio($podcast);

echo "Finished at: " . date('H:i:s') . "\n";
echo "Result: " . ($result['success'] ? 'SUCCESS' : 'FAILED') . "\n";

if ($result['success']) {
    echo "Audio Path: {$result['audio_path']}\n";
    $podcast->update([
        'audio_path' => $result['audio_path'],
        'status' => 'completed'
    ]);
    echo "Podcast updated!\n";
} else {
    echo "Error: " . ($result['error'] ?? 'Unknown') . "\n";
}
