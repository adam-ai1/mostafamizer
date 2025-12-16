<?php 

namespace Modules\OpenAI\Contracts\Responses\Video;
use Exception;

interface CheckVideoResponseContact
{
    /**
     * Get the current status of the process.
     *
     * Possible return values:
     * - succeeded : The process completed successfully.
     * - queued    : The process is waiting to be executed.
     * - running   : The process is currently executing.
     * - failed    : The process encountered an error and did not complete.
     * - canceled  : The process was cancelled before completion.
     *
     * @return string One of: succeeded, queued, running, failed, canceled.
     */
    public function status(): string;
    
    public function urls(): array;
    
    /**
     * Get the response content.
     *
     * @return mixed The content of the response.
     */
    public function response(): mixed;

    /**
     * Handle any errors that occurred during the response generation.
     *
     * @throws ResponseGenerationException If an error occurred during response generation.
     */
    public function handleException(string $message): \Exception;
}