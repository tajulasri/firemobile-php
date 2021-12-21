<?php

namespace Firemobile;

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
     * @param $httpClient
     * @param $config
     */
    public function __construct($httpClient, array $config)
    {
        $this->httpClient = $httpClient;
        $this->config = $config;
    }

    /**
     * @param $httpClient
     * @param array         $config
     */
    public function make($httpClient, array $config)
    {
        return new self($httpClient, $config);
    }

    /**
     * @return mixed
     */
    public function config()
    {
        return $this->config;
    }

    /**
     * @return mixed
     */
    public function httpClient()
    {
        return $this->httpClient;
    }

    public function __toString()
    {
        return json_encode($this->config);
    }
}
