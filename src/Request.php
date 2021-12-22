<?php

namespace Firemobile;

use Laravie\Codex\Common\Response;
use Psr\Http\Message\ResponseInterface;

abstract class Request
{
    /**
     * Resolve the responder class.
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    protected function responseWith(ResponseInterface $message)
    {
        return new Response($message);
    }

    /**
     * Get API Header.
     *
     * @return array<string, mixed>
     */
    protected function getApiHeaders(): array
    {
        return [];
    }

    /**
     * Get API Body.
     */
    protected function getApiBody(): array
    {
        return [];
    }

    /**
     * Merge API Headers.
     *
     * @param array<string, mixed> $headers
     *
     * @return array<string, mixed>
     */
    final protected function mergeApiHeaders(array $headers = []): array
    {
        return array_merge($this->getApiHeaders(), $headers);
    }

    /**
     * Merge API Body.
     */
    final protected function mergeApiBody(array $body = []): array
    {
        return array_merge($this->getApiBody(), $body);
    }

    abstract public function send();
}
