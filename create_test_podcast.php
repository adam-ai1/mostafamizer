<?php
/**
 * Create and process a new test podcast
 */

require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\OpenAI\Services\PodcastService;
use Modules\OpenAI\Entities\Podcast;

ini_set('max_execution_time', 0);
set_time_limit(0);

echo "=== Creating New Test Podcast ===\n";
echo "Start: " . date('H:i:s') . "\n\n";

$service = new PodcastService();

// Create podcast
$result = $service->createPodcast([
    'user_id' => 1,
    'topic' => 'فوائد القهوة للصحة',
    'source_material' => null,
]);

if (!$result['success']) {
    die("Failed to create podcast: " . $result['error'] . "\n");
}

$podcast = $result['podcast'];
echo "Created Podcast ID: {$podcast->id}\n";
echo "Status: {$podcast->status}\n\n";

// Now process it directly (bypass queue)
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

echo "Script generated!\n";
echo "Word Count: " . $scriptResult['word_count'] . "\n";
echo "Duration: " . $scriptResult['estimated_duration'] . "\n";
echo "Parsed Lines: " . count($podcast->fresh()->parsed_script) . "\n\n";

echo "=== Step 2: Generating Audio ===\n";
echo "This may take a few minutes...\n";

$audioResult = $service->generatePodcastAudio($podcast->fresh());

if ($audioResult['success']) {
    $podcast->update([
        'audio_path' => $audioResult['audio_path'],
        'status' => Podcast::STATUS_COMPLETED
    ]);
    
    echo "\nSUCCESS!\n";
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
echo "Total Podcast Status: " . $podcast->fresh()->status . "\n";
