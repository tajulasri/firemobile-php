<?php

namespace Firemobile;

use Firemobile\Client;
use Firemobile\Contracts\Authenticable;

class FiremobileAuth implements Authenticable
{
    /**
     * @var mixed
     */
    protected $client;

    /**
     * @param $config
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $config
     */
    public static function make(Client $client)
    {
        return new self($client);
    }

    public function credentials()
    {
        return [
            'gw-username' => $this->client->config()['username'],
            'gw-password' => $this->client->config()['password'],
        ];
    }

    /**
     * @return mixed
     */
    public function client()
    {
        return $this->client;
    }
}
