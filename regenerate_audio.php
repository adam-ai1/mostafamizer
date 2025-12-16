<?php

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\OpenAI\Entities\Podcast;
use Modules\OpenAI\Services\PodcastService;

$podcast = Podcast::find(7);

if (!$podcast) {
    echo "Podcast not found\n";
    exit(1);
}

echo "Podcast ID: {$podcast->id}\n";
echo "Status: {$podcast->status}\n";
echo "Has Script: " . (!empty($podcast->script) ? 'Yes' : 'No') . "\n";
echo "Parsed Script Lines: " . count($podcast->parsed_script ?? []) . "\n";
echo "Current Audio Path: " . ($podcast->audio_path ?? 'NONE') . "\n";

// Generate audio
echo "\n=== Generating Audio ===\n";

$service = app(PodcastService::class);
$result = $service->generatePodcastAudio($podcast);

echo "\nResult: " . ($result['success'] ? 'SUCCESS' : 'FAILED') . "\n";

if ($result['success']) {
    echo "Audio Path: {$result['audio_path']}\n";
    
    // Update podcast
    $podcast->update(['audio_path' => $result['audio_path']]);
    echo "Podcast updated!\n";
} else {
    echo "Error: " . ($result['error'] ?? 'Unknown') . "\n";
}
