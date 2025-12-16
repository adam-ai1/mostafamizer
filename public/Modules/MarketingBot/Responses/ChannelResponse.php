<?php

namespace Modules\MarketingBot\Responses;

class ChannelResponse implements ResponseInterface
{
    protected bool $success;
    protected int $code;
    protected array $data;
    protected ?array $error;
    protected string $message;

    /**
     * Create a new ChannelResponse instance.
     *
     * @param bool $success Whether the response was successful.
     * @param int $code HTTP status code.
     * @param array $data Response data.
     * @param array|null $error Error details.
     * @param string $message Human-readable message.
     */
    public function __construct(bool $success, int $code, array $data = [], ?array $error = null, string $message = '')
    {
        $this->success = $success;
        $this->code = $code;
        $this->data = $data;
        $this->error = $error;
        $this->message = $message;
    }

    /**
     * Create a successful response.
     *
     * @param int $code HTTP status code.
     * @param array $data Response data.
     * @param string $message Optional message.
     * @return static
     */
    public static function success(int $code, array $data = [], string $message = 'Success'): self
    {
        return new self(true, $code, $data, null, $message);
    }

    /**
     * Create an error response.
     *
     * @param int $code HTTP status code.
     * @param array $error Error details.
     * @param string $message Error message.
     * @param array $data Optional additional data.
     * @return static
     */
    public static function error(int $code, array $error = [], string $message = 'Error', array $data = []): self
    {
        return new self(false, $code, $data, $error, $message);
    }

    /**
     * Create a response from raw cURL response.
     *
     * @param array $rawResponse Raw response with 'code' and 'body' keys.
     * @return static
     */
    public static function fromRawResponse(array $rawResponse): self
    {
        $code = $rawResponse['code'] ?? 500;
        $body = $rawResponse['body'] ?? [];

        // Determine if response is successful (2xx status codes)
        $success = $code >= 200 && $code < 300;

        if ($success) {
            return self::success($code, $body, 'Request successful');
        }

        // Extract error details from body
        $error = $body['error'] ?? $body;
        $message = $error['message'] ?? $error['error_user_msg'] ?? 'An error occurred';

        return self::error($code, $error, $message, $body);
    }

    /**
     * Check if the response was successful.
     *
     * @return bool
     */
    public function successful(): bool
    {
        return $this->success;
    }

    /**
     * Check if the response failed.
     *
     * @return bool
     */
    public function failed(): bool
    {
        return !$this->success;
    }

    /**
     * Get the HTTP status code.
     *
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * Get the response data.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Get error details if response failed.
     *
     * @return array|null
     */
    public function getError(): ?array
    {
        return $this->error;
    }

    /**
     * Get the response message.
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Convert response to array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'code' => $this->code,
            'data' => $this->data,
            'error' => $this->error,
            'message' => $this->message,
        ];
    }

    /**
     * Convert response to JSON string.
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}

