<?php
/**
 * Complete podcast 12 audio generation with detailed logging
 */

require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\OpenAI\Services\PodcastService;
use Modules\OpenAI\Entities\Podcast;
use Illuminate\Support\Facades\Log;

ini_set('max_execution_time', 0);
set_time_limit(0);

echo "=== Completing Podcast 12 ===\n";
echo "Start: " . date('H:i:s') . "\n\n";

$podcast = Podcast::find(12);

if (!$podcast) {
    die("Podcast 12 not found\n");
}

echo "Title: " . mb_substr($podcast->title, 0, 50) . "\n";
echo "Script Length: " . strlen($podcast->script) . " chars\n";
echo "Parsed Lines: " . count($podcast->parsed_script) . "\n\n";

$service = new PodcastService();

echo "Starting audio generation...\n";
echo str_repeat('-', 50) . "\n";

try {
    $result = $service->generatePodcastAudio($podcast);
    
    echo str_repeat('-', 50) . "\n";
    echo "Finished: " . date('H:i:s') . "\n";
    
    if ($result['success']) {
        $podcast->update([
            'audio_path' => $result['audio_path'],
            'status' => Podcast::STATUS_COMPLETED
        ]);
        
        echo "SUCCESS!\n";
        echo "Audio Path: " . $result['audio_path'] . "\n";
        
        $fullPath = storage_path('app/public/podcasts/' . basename($result['audio_path']));
        if (file_exists($fullPath)) {
            echo "File Size: " . round(filesize($fullPath) / 1024 / 1024, 2) . " MB\n";
        }
    } else {
        $podcast->update([
            'status' => Podcast::STATUS_FAILED,
            'error_message' => $result['error'] ?? 'Unknown error'
        ]);
        echo "FAILED: " . ($result['error'] ?? 'Unknown') . "\n";
    }
} catch (Exception $e) {
    $podcast->update([
        'status' => Podcast::STATUS_FAILED,
        'error_message' => $e->getMessage()
    ]);
    echo "EXCEPTION: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\nDone.\n";
