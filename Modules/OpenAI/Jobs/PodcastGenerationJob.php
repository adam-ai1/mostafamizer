<?php

/**
 * @package PodcastGenerationJob
 * @author VoxCraft
 * @created 2024-12-14
 */

namespace Modules\OpenAI\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\OpenAI\Entities\Podcast;
use Modules\OpenAI\Services\PodcastService;

class PodcastGenerationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 2;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 600; // 10 minutes for audio generation

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var array
     */
    public $backoff = [60, 120];

    /**
     * The podcast ID
     *
     * @var int
     */
    protected int $podcastId;

    /**
     * Create a new job instance.
     *
     * @param int $podcastId
     * @return void
     */
    public function __construct(int $podcastId)
    {
        $this->podcastId = $podcastId;
        $this->onQueue('podcast-generation');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        // Increase PHP timeout for this job
        set_time_limit(900); // 15 minutes
        ini_set('max_execution_time', 900);
        
        $podcast = Podcast::find($this->podcastId);

        if (!$podcast) {
            return;
        }

        // Skip if already completed or processing
        if ($podcast->isCompleted()) {
            return;
        }

        try {
            // Update status to processing
            $podcast->update(['status' => Podcast::STATUS_PROCESSING]);

            // Get the podcast service
            $podcastService = app(PodcastService::class);

            // Generate the podcast script
            $result = $podcastService->generatePodcastScript($podcast);

            if ($result['success']) {
                $podcast->update([
                    'script' => $result['script'],
                    'word_count' => $result['word_count'],
                    'estimated_duration' => $result['estimated_duration'],
                    'title' => $result['title'] ?? $podcast->title,
                ]);

                // Try to generate audio (optional - won't fail if ElevenLabs is not configured)
                $audioResult = $podcastService->generatePodcastAudio($podcast->fresh());
                
                if ($audioResult['success']) {
                    $podcast->update([
                        'audio_path' => $audioResult['audio_path'],
                    ]);
                }

                // Mark as completed
                $podcast->update(['status' => Podcast::STATUS_COMPLETED]);
            } else {
                $this->handleFailure($podcast, $result['error'] ?? 'Unknown error occurred');
            }
        } catch (Exception $e) {
            $this->handleFailure($podcast, $e->getMessage());
            throw $e;
        }
    }

    /**
     * Handle job failure
     *
     * @param Podcast $podcast
     * @param string $errorMessage
     * @return void
     */
    protected function handleFailure(Podcast $podcast, string $errorMessage): void
    {
        $podcast->update([
            'status' => Podcast::STATUS_FAILED,
            'error_message' => $errorMessage,
        ]);
    }

    /**
     * Handle a job failure.
     *
     * @param \Throwable $exception
     * @return void
     */
    public function failed(\Throwable $exception): void
    {
        $podcast = Podcast::find($this->podcastId);

        if ($podcast) {
            $podcast->update([
                'status' => Podcast::STATUS_FAILED,
                'error_message' => $exception->getMessage(),
            ]);
        }
    }
}
