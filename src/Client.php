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
     * @param array         $config
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

        $param = [
            'gw-dlr-mask' => $this->receivedCallback(),
            'gw-dlr-url'  => $this->callbackurl(),
        ];

        $this->config = array_merge($this->config(), $param);

        return $this;
    }

    /**
     * @param  $url
     * @return mixed
     */
    private function handleReceivedCallback($url)
    {
        return $this->receivedCallback = ($url == null ? false : true);
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
