<?php

namespace Firemobile;

use Psr\Http\Client\ClientInterface;

class Client
{
    /**
     * @var mixed
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var mixed
     */
    protected $endpoint = 'https://demo.firemobile.co/cgi-bin';

    /**
     * @var mixed
     */
    protected $receivedCallback = false;

    /**
     * @var mixed
     */
    protected $callbackurl = null;

    /**
     * @param $httpClient
     * @param $config
     */
    public function __construct(ClientInterface $httpClient, array $config)
    {
        $this->httpClient = $httpClient;
        $this->config = $config;
    }

    /**
     * @param $httpClient
     */
    public static function make(ClientInterface $httpClient, array $config): self
    {
        return new self($httpClient, $config);
    }

    /**
     * @return mixed
     */
    public function endpoint(): string
    {
        return array_key_exists('endpoint', $this->config()) ? $this->config()['endpoint'] : $this->endpoint;
    }

    /**
     * @return mixed
     */
    public function callback($url): self
    {
        $this->handleReceivedCallback($url);

        $this->callbackurl = $url;

        $this->config = array_merge($this->config(), $this->callbackBody());

        return $this;
    }

    /**
     * @param $url
     *
     * @return mixed
     */
    private function handleReceivedCallback($url)
    {
        return $this->receivedCallback = $url == null ? 0 : 1;
    }

    /**
     * @return mixed
     */
    public function receivedCallback()
    {
        return $this->receivedCallback;
    }

    /**
     * @return mixed
     */
    public function callbackurl()
    {
        return $this->callbackurl;
    }

    public function callbackBody()
    {
        return [
            'Gw-Dlr-Mask' => $this->receivedCallback(),
            'Gw-Dlr-Url'  => $this->callbackurl(),
        ];
    }

    /**
     * @return mixed
     */
    public function config(): array
    {
        return $this->config;
    }

    /**
     * @return mixed
     */
    public function httpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    public function __toString()
    {
        return json_encode($this->config);
    }
}
