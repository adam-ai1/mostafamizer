<?php

namespace Modules\MarketingBot\Responses;

interface ResponseInterface
{
    /**
     * Check if the response was successful.
     *
     * @return bool
     */
    public function successful(): bool;

    /**
     * Check if the response failed.
     *
     * @return bool
     */
    public function failed(): bool;

    /**
     * Get the HTTP status code.
     *
     * @return int
     */
    public function getCode(): int;

    /**
     * Get the response data.
     *
     * @return array
     */
    public function getData(): array;

    /**
     * Get error details if response failed.
     *
     * @return array|null
     */
    public function getError(): ?array;

    /**
     * Get the response message.
     *
     * @return string
     */
    public function getMessage(): string;

    /**
     * Convert response to array.
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * Convert response to JSON string.
     *
     * @return string
     */
    public function toJson(): string;
}

