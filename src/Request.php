<?php

namespace Firemobile;

use Laravie\Codex\Common\Response;
use Psr\Http\Message\ResponseInterface;

class Request
{
    /**
     * Resolve the responder class.
     *
     * @param  \Psr\Http\Message\ResponseInterface $message
     * @return \Laravie\Codex\Contracts\Response
     */
    protected function responseWith(ResponseInterface $message): Contracts\Response
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
     *
     * @return array
     */
    protected function getApiBody(): array
    {
        return [];
    }

    /**
     * Merge API Headers.
     *
     * @param  array<string, mixed>   $headers
     * @return array<string, mixed>
     */
    final protected function mergeApiHeaders(array $headers = []): array
    {
        return array_merge($this->getApiHeaders(), $headers);
    }

    /**
     * Merge API Body.
     *
     * @param  array   $body
     * @return array
     */
    final protected function mergeApiBody(array $body = []): array
    {
        return array_merge($this->getApiBody(), $body);
    }

    abstract function send();
}
