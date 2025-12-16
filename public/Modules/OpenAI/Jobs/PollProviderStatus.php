<?php

namespace Modules\OpenAI\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\OpenAI\Services\v2\TextToVideoService;
use Modules\OpenAI\Services\v2\ImageToVideoService;
use Modules\OpenAI\Entities\VideoJob;
use Modules\OpenAI\Entities\Archive;
use Exception;

class PollProviderStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // …and/or cap the number of attempts
    public $tries = 120; // plenty, given your backoff caps at ~60s

    // Optional Laravel-level backoff (used if the job throws)
    public $backoff = [5, 10, 20, 40, 60];
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public int $videoJobId, public string $provider) {
        $this->onQueue('video-poll');
    }

    // Either: allow many tries but bounded by time…
    public function retryUntil()
    {
        return now()->addMinutes(30); // stop after 30 minutes
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $job = VideoJob::find($this->videoJobId);
        if (!$job) return;

        if (in_array($job->status, ['failed','canceled'])) return;

        try {
            $archive = Archive::with('metas')
                ->whereHas('metas', fn($q) => $q->where('key', 'video_job_id')
                    ->where('value', $this->videoJobId))
                ->first();

            request()->merge(['provider' => $job->provider, 'options' => json_decode($job->generation_options)]);
            $service = $archive->type == 'text_to_video_chat' ? new TextToVideoService() : new ImageToVideoService();
            $video = $service->fetchVideoStatus($job->provider_task_id);

        } catch (\Throwable $e) {
            $job->status = 'failed';
            $job->error = $e->getMessage();
            $job->save();

            if (method_exists($this, 'fail')) {
                $this->fail($e);
            }

            return;
        }

        $now = now();
        if ($video) {
            if (is_null($job->started_at)) $job->started_at = $now;

            $job->status = $video->status ?? $job->status;

            if (!empty($video->urls)) {
                $job->result_url = $video->urls;
            }
        }

        if ($job->status == 'succeeded') {
            $service->fetchVideo($archive);
            $job->next_check_at = null;
            $job->save();
            return;        
        }

        // schedule next poll
        $delay = $this->nextDelay(); // based on queue attempts
        $job->next_check_at = $now->clone()->addSeconds($delay);
        $job->save();

        $this->release($delay);
    }

    protected function nextDelay(): int
    {
        // use queue attempts, not your DB column
        $n = max(1, $this->attempts()); // 1-based
        $delay = (int) round(pow(1.8, $n));
        $delay = min(60, $delay) + random_int(0, 3);
        return $delay;
    }
}
