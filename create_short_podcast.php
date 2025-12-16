<?php
/**
 * Create and complete a short podcast - runs synchronously
 */

require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\OpenAI\Services\PodcastService;
use Modules\OpenAI\Entities\Podcast;

ini_set('max_execution_time', 0);
set_time_limit(0);

echo "=== Creating Short Podcast (6 turns) ===\n";
echo "Start: " . date('H:i:s') . "\n\n";

$service = new PodcastService();

// Create podcast
$result = $service->createPodcast([
    'user_id' => 1,
    'topic' => 'نصائح لحياة صحية',
    'source_material' => null,
]);

if (!$result['success']) {
    die("Failed to create podcast: " . $result['error'] . "\n");
}

$podcast = $result['podcast'];
echo "Created Podcast ID: {$podcast->id}\n\n";

// Step 1: Generate Script
echo "=== Step 1: Generating Script ===\n";
$podcast->update(['status' => Podcast::STATUS_PROCESSING]);

$scriptResult = $service->generatePodcastScript($podcast);

if (!$scriptResult['success']) {
    die("Script generation failed: " . $scriptResult['error'] . "\n");
}

$podcast->update([
    'script' => $scriptResult['script'],
    'word_count' => $scriptResult['word_count'],
    'estimated_duration' => $scriptResult['estimated_duration'],
    'title' => $scriptResult['title'] ?? $podcast->title,
]);

$podcast = $podcast->fresh();
echo "Script generated: " . strlen($podcast->script) . " chars\n";
echo "Word Count: " . $scriptResult['word_count'] . "\n";
echo "Parsed Lines: " . count($podcast->parsed_script) . "\n";
echo "Time: " . date('H:i:s') . "\n\n";

// Step 2: Generate Audio
echo "=== Step 2: Generating Audio ===\n";
echo "This will take about " . (count($podcast->parsed_script) * 10) . " seconds...\n\n";

$startAudio = time();
$audioResult = $service->generatePodcastAudio($podcast);
$endAudio = time();

$audioTime = $endAudio - $startAudio;
echo "\nAudio generation took: {$audioTime} seconds\n";

if ($audioResult['success']) {
    $podcast->update([
        'audio_path' => $audioResult['audio_path'],
        'status' => Podcast::STATUS_COMPLETED
    ]);
    
    echo "\n=== SUCCESS! ===\n";
    echo "Audio Path: " . $audioResult['audio_path'] . "\n";
    
    $fullPath = storage_path('app/public/podcasts/' . basename($audioResult['audio_path']));
    if (file_exists($fullPath)) {
        echo "File Size: " . round(filesize($fullPath) / 1024 / 1024, 2) . " MB\n";
    }
} else {
    $podcast->update([
        'status' => Podcast::STATUS_FAILED,
        'error_message' => $audioResult['error'] ?? 'Unknown error'
    ]);
    echo "FAILED: " . ($audioResult['error'] ?? 'Unknown') . "\n";
}

echo "\nFinished: " . date('H:i:s') . "\n";
echo "Podcast Status: " . $podcast->fresh()->status . "\n";
