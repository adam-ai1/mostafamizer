<?php

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\OpenAI\Entities\Podcast;
use Modules\OpenAI\Jobs\PodcastGenerationJob;

// Find podcast 11
$podcast = Podcast::find(11);

if (!$podcast) {
    echo "Podcast not found\n";
    exit(1);
}

echo "Podcast ID: {$podcast->id}\n";
echo "Status: {$podcast->status}\n";

// Reset status
$podcast->update([
    'status' => 'pending',
    'error_message' => null
]);

echo "Status reset to pending\n";

// Dispatch job
PodcastGenerationJob::dispatch($podcast->id);

echo "Job dispatched!\n";
echo "Now run: php artisan queue:work --queue=podcast-generation --once\n";
